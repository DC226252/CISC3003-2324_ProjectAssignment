<?php

class Account{
    public $id;
    public $password;


}
class Customer{
    public $id;
    public $name;
    public $contact;

    
}
class customerLogin{
    public $account_id;
    public $customer_id;

    
}
class Staff{
    public $id;
    public $name;
    public $position;
    public $contact;
    
}
class staffLogin{
    public $account_id;
    public $staff_id;
    public $position;
    
}
class Reservation{
    public $id;
    public $customer_id;
    public $room_id;
    public $checkinDate;
    public $checkoutDate;

    
}
class Appoint{
    public $reservation_id;
    public $room_id;


}
class Room{
    public $id;
    public $roomNum;
    public $type; //should be meaning one people or two people
    public $status;


}
class Order{
    public $id;
    public $customer_id;
    public $reservation_id;
    public $status;
    public $price;
    public $type;
    public $date;
}


?>