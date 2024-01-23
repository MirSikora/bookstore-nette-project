<?php
declare(strict_types=1);

namespace App\Model;

use Nette\SmartObject;

class Order
{

    use SmartObject;

    private int $order_id;
    private string $order_number;
    private string $order_date;
    private int $client_id;
    private Transport $transport;
    private Payment $payment;
    private array $books;

    public function __construct(int $order_id, string $order_number, string $order_date, int $client_id, Transport $transport, Payment $payment,array $books)
    {
        $this->setOrderId($order_id);
        $this->setOrderNumber($order_number);
        $this->setOrderDate($order_date);
        $this->setClientId($client_id);
        $this->setTransport($transport);
        $this->setPayment($payment);
        $this->setBooks($books);
    }

    public function getOrderId()
    {
        $this->order_id;
    }
    public function setOrderId(int $order_id)
    {
        $this->order_id = $order_id;
    }
    public function getOrderNumber()
    {
        $this->order_number;
    }
    public function setOrderNumber(string $order_number)
    {
        $this->order_number = $order_number;
    }
    public function getOrderDate()
    {
        $this->order_date;
    }
    public function setOrderDate(string $order_date)
    {
        $this->order_date = $order_date;
    }
    public function getClientId()
    {
        $this->client_id;
    }
    public function setClientId(int $client_id)
    {
        $this->client_id = $client_id;
    }
    public function getTransport()
    {
        $this->transport;
    }
    public function setTransport(Transport $transport)
    {
        $this->transport = $transport;
    }
    public function getPayment()
    {
        $this->payment;
    }
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
    }
    public function getBooks()
    {
        $this->books;
    }
    public function setBooks(array $books)
    {
        $this->books = $books;
    }

}