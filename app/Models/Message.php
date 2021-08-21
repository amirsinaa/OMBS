<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

  protected $table = 'messages';


  protected $fillable = array('bid_id', 'sender_id', 'recipient_id',  'message');

  public function Bid()
  {

    return $this->belongsTo('Bid', 'bid_id');
  }

  public function Sender()
  {

    return $this->belongsTo('\App\Models\User', 'sender_id');
  }


  public function Recipient()
  {

    return $this->belongsTo('User', 'recipient_id');
  }
}
