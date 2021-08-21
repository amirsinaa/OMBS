
@extends('layouts.app')
@section("content")

  <div class="container">
    <h2>Admin Panel</h2><br><br>
    <div class="list-group">
      <a class="text-center h3 list-group-item" href="{{ URL::to('product/superadminproductlist') }}" >All products</a>
      <br>
      <a class="text-center h3 list-group-item" href="{{ URL::to('superadmin/userlist') }}" >Auction users list</a>
      <br>
      <a class="text-center h3 list-group-item" href="{{ URL::to('superadminbids') }}" >All bids</a>
      <br>
      <br>
      <div class="text-center list-group-item server-info">
        <h3 class="py-2 pb-0 mb-0">Admin info:</h3><hr>
        The picture upload depend on servers parameter.<br>
        The compressed file formats (like JPEG) needs much more memory than the actual file size!<br>
        memory limit:  <?php echo ini_get('memory_limit'); ?> <br>
        Maximum allowed size for uploaded files:  <?php echo ini_get('upload_max_filesize'); ?> <br>
        Whether to allow HTTP file uploads:  <?php echo ini_get('file_uploads'); ?> <br>
        Maximum size of POST data that PHP will accept:  <?php echo ini_get('post_max_size'); ?> <br>
      </div>
    </div>
  </div>

@stop
