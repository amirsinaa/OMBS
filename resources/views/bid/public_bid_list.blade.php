@extends('layouts.app')
@section('head')
  <style>
    tr.border_bottom td {
      border-bottom : 1pt solid black;
    }
    img {
      width : 100px;
    }
  </style>
  <script>
    $(function() {
      $(".show_message_link").click(function() {
        curr_element = $(this).attr('id');
        $.ajax({url : '{{ URL::to(' / message / get / ') }}' + '/' + $(this).attr('id').substr(7),success: function(result) {$('#' + curr_element).parent().add("<div class='message_wrapper'> message place </div>").html(result)}
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $(".timelimit_place").each(function(index) {
          var date1 = $(this).html();
          var date2 = new Date();
          var date1 = new Date(date1.replace(/-/g, '/'));
          if (date1 > date2) {
            $(this).css('color', 'green');
          } else {
            $(this).css('color', 'red');
          }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $(".daydiff_place").each(function(index) {
        var current_number = $(this).html();
        if (current_number > 0) {
          $(this).css('color', 'green');
        } else {
          $(this).css('color', 'red');
        }
      });
    });
  </script>
@stop

@section('content')
  <div class="container">
    <h1> @lang('c.Bid list') </h1>
    <table class="table">
      <tbody>
        <tr>
          <td></td>
          <td><b>{{ trans('c.Name') }}</b></td>
          <td><b>{{ trans('c.Opening price') }}</b></td>
          <td><b>{{ trans('c.Bid') }}</b></td>
          <td><b> @lang('c.End of the Auction')</b></td>
          <td><b> @lang('c.Number of the days')</b></td>
          <td><b>{{ trans('c.Sender') }}</b></td>
          <td><b>{{ trans('c.Owner') }}</b></td>
          <td><b> @lang('c.Date')</b></td>
        </tr>
        @foreach ($bid_products as $bid_item)
          <tr>
            <td>
              <img src="{{ URL::to('/uploads/products/thumbs/small/' . $bid_item->image1) }}" alt="picture">
            </td>
            <td>
              <a href="{{ URL::to('product/' . $bid_item->product_id) }}"> {{ $bid_item->title }} </a>
            </td>
            <td>
              @if ($bid_item->opening_price != '')
                {{ $bid_item->opening_price }} {{ $bid_item->currency }}
              @endif
            </td>
            <td>
              <span class="timelimit_place">{{ $bid_item->timelimit }}</span>
            </td>
            <td>
              <span class="daydiff_place">{{ $bid_item->daydiff }}</span>
            </td>
            <td>
              {{ $bid_item->cost_name }}
              <br>
            </td>
            <td>
              {{ $bid_item->owner_name }}
            </td>
            <td> {{ $bid_item->bids_created_at }} </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <br>
    <?php echo $bid_products->links(); ?>
  </div>
@stop