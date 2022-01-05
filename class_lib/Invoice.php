<?php
    require_once("Patient.php");
    class Invoice{
        private $db;
        private $id;
        private $invoiceNumber;
        private $dueDate;
        private $date;
        private $patient;
        private $staff;
        private $payments = [];
        private $items = [];

        function __construct($db, $id=-2){
            $this->db = $db;
            if($id>0){
                $qry = "SELECT * FROM invoices WHERE id = ?";
                $data = [$id];
                $res = $this->db->selectOne($qry, $data);
                if($res['status']){
                    $invoice = $res['data'];
                    $this->id = $invoice['id'];
                    $this->invoiceNumber = $invoice['invoice_number'];
                    $this->dueDate = $invoice['due_date'];
                    $this->patient = $invoice['patient'];
                    $this->staff = $invoice['staff'];
                    $this->date = $invoice['date'];

                    $qry = "SELECT * FROM invoice_payments WHERE invoice = ?";
                    $data = [$this->id];
                    $this->payments = $this->db->selectMany($qry, $data)['data'];

                    $qry = "SELECT * FROM invoice_items WHERE invoice = ?";
                    $data = [$this->id];
                    $this->items = $this->db->selectMany($qry, $data)['data'];
                }
            }
        }

        function getId(){
            return $this->id;
        }

        function getInvoiceNumber(){
            return $this->invoiceNumber;
        }

        function getDate(){
            return $this->date;
        }

        function setDate($date){
            $this->date = $date;
        }

        function getDueDate(){
            return $this->dueDate;
        }

        function setDueDate($date){
            $this->dueDate = $date;
        }

        function getStaff(){
            return new Staff($this->db, $this->staff);
        }

        function setStaff($staff){
            $this->staff = $staff;
        }

        function getPatient(){
            return new Patient($this->db, $this->patient);
        }

        function setPatient($patient){
            $this->patient = $patient;
        }

        function getItems(){
            return $this->items;
        }

        function addItem($item, $cost, $qty){
            $this->items[count($this->items)] = ['invoice'=>$this->id, 'item'=>$item, 'cost'=>$cost, 'qty'=>$qty];
        }

        function getPayments(){
            return $this->payments;
        }

        //function to automatically generate a unique invoice number when saving an invoice
        public function generateInvoiceNumber(){
			$qry = "SELECT current_value FROM invoice_seed";
			$data = [];
            $res = $this->db->selectOne($qry, $data);
			if ($res['status']) {
				$current = $res['data']['current_value'];
				$current++;
				$invoiceNum = "ATH".$current;
			}

			$qry = "UPDATE invoice_seed SET current_value = ?";
			$data = [$current];
            $this->db->update($qry, $data);

			return $invoiceNum;
		}

        //If an invoice cannot be save the reverseInvoiceNum is used to reset the invoice number to its former value
        public function reverseInvoiceNum(){
			$qry = "SELECT current_value FROM invoice_seed";
			$data = [];
            $res = $this->db->selectOne($qry, $data);

			$current = $res['data']['current_value'];
			$current--;
			$qry = "UPDATE invoice_seed SET current_value = ? WHERE branch = ?";
            $res = $this->db->update($qry, [$current]);

			if($res['status']){
				return ['status'=>1, 'message'=>'Invoice number reversed successfully'];
			}
			else{
				return ['status'=>0, 'message'=>'Could not reverse invoice number'];
			}
		}

        function save(){
            $qry = "INSERT INTO invoices (patient, date, due_date, staff, invoice_number) VALUES (?, ?, ?, ?, ?)";
            $data = [$this->patient, $this->date, $this->dueDate, $this->staff, $this->generateInvoiceNumber()];

            $this->db->beginTransaction();
            $res = $this->db->insert($qry, $data);
            if($res['status']){
                $id = $res['id'];
                $qry = "INSERT INTO invoice_items (invoice, item, cost, qty) VALUES (?, ?, ?, ?)";
                foreach($this->items as $item){
                    $data = [$id, $item['item'], $item['cost'], $item['qty']];
                    $res = $this->db->insert($qry, $data);
                }
                $this->db->commitTransaction();
                return $res;
            }else{
                $this->db->rollBack();print_r($res);
                $this->reverseInvoiceNum();
                return ['status'=>0, 'error'=>"An error occurred while saving invoice"];
            }
        }

        function savePayment($amount, $method, $date){
            $qry = "INSERT INTO invoice_payments (invoice, amount, method, date) VALUES (?, ?, ?, ?)";
            $data = [$this->id, $amount, $method, $date];

            return $this->db->insert($qry, $data);
        }
    }

// $db = new Database();
// $db->openConnection();

// $invoice = new Invoice($db);
// $invoice->setPatient(1);
// $invoice->setStaff(1);
// $invoice->setDate(Date("Y-m-d"));
// $invoice->setDueDate(Date("Y-m-d"));
// $invoice->addItem("Bed space", 2500, 3);
// $invoice->addItem("C-Section", 25000, 1);
// print_r($invoice->save());