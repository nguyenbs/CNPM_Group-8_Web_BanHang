
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>
      Chào mừng đến FlatShop
    </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
      <meta name="csrf-token" content="<?= csrf_token() ?>">
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
</script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js">
</script>
<![endif]-->
  </head>
  <body>
    <div class="wrapper">
      @include('header');
      <div class="clearfix">
      </div>
      <div class="container_fullwidth">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <div class="products-details">
                <div class="preview_image">
                  <div class="preview-small">
                    <img id="zoom_03" src="{{$product->pictures}}" data-zoom-image="{{$product->pictures}}" alt="">
                  </div>
                  <div class="thum-image">
                    <ul id="gallery" class="prev-thum">
                      <?php for($i=0;$i<count($pro_category);$i++){ ?>
                      <li>
                        <!-- <a href="details={{$pro_category[$i]['productID']}}" data-image="{{$pro_category[$i]['pictures']}}" data-zoom-image="{{$pro_category[$i]['pictures']}}">
                          <img src="{{$pro_category[$i]['pictures']}}" alt="">
                        </a> -->
                        <a href="details={{$pro_category[$i]['productID']}}">
                          <img src="{{$pro_category[$i]['pictures']}}" alt="">
                        </a>
                      </li>
                      <?php } ?>
                    </ul>
                    <a class="control-left" id="thum-prev" href="javascript:void(0);">
                      <i class="fa fa-chevron-left">
                      </i>
                    </a>
                    <a class="control-right" id="thum-next" href="javascript:void(0);">
                      <i class="fa fa-chevron-right">
                      </i>
                    </a>
                  </div>
                </div>
                <div class="products-description">
                  <h5 class="name">
                    {{$product->productname}}
                    
                  </h5>
                  <p>
                    <img alt="" src="images/star.png">
                    <a class="review_num" href="#">
                      02 Đánh giá
                    </a>
                  </p>
                  <p>
                    Tình trạng:
                    <?php if($product->quantuminstock >0) {
                    ?>
                    <span class=" light-red">
                      Còn hàng
                    </span>
                    <?php 
                      }else{
                    ?>
                     <span class=" light-red">
                      Hết hàng
                    </span><?php } ?>
                  </p>
                  <p>

                    {{$product->desciption}}
                  </p>
                  <hr class="border">
                  <div class="price">
                    Gía : 
                    <span class="new_price">
                      {{$product->price}}
                      <sup>
                        $
                      </sup>
                    </span>
                    <span class="old_price">
                      {{($product->price)+10}}
                      <sup>
                        $
                      </sup>
                    </span>
                  </div>
                  <hr class="border">
                  <div class="wided">                    
                    <?php   
                        $check = false;
                        if(Cookie::get('amount') < 4)                                                        
                           $lm = Cookie::get('amount');
                        else
                           $lm = 3;
                        $ls_order = App\Order::where('userID',Auth::check() ? Auth::id() : Cookie::get('user_ip'))->where('isActive',1)->orderBy('orderID','desc')->limit($lm)->get();
                        foreach ($ls_order as $order) {
                           if($order->productID == (int)$product->productID)
                              $check = true;
                        }                                                                   
                     ?>                                 
                     @if($check == true)
                        <div class="button_group_{{$product->productID}}"><a href="/cart"><button class="button" style="padding: 12px">Giỏ hàng</button></a><button class="button compare" style="margin: 5px" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                     @else
                        <div class="button_group_{{$product->productID}}"><button class="button add-cart" id="order_{{$product->productID}}" style="padding: 12px" type=" button">Mua</button><button class="button compare" style="margin: 5px" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                     @endif
                  </div>
                  <div class="clearfix">
                  </div>
                  <hr class="border">
                  <img src="images/share.png" alt="" class="pull-right">
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="tab-box">
                <div id="tabnav">
                  <ul>
                    <li>
                      <a href="#Descraption">
                        Mô tả
                      </a>
                    </li>
                    <li>
                      <a href="#Reviews">
                        Đánh giá
                      </a>
                    </li>
                    <li>
                      <a href="#tags">
                        Thẻ sản phẩm
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content-wrap">
                  <div class="tab-content" id="Descraption">
                    <p>
                     {{$product->desciption}}
                    </p>
                    
                  </div>
                  <div class="tab-content" id="Reviews">
                    <form id="danhgia">
                      <table>
                        <thead>
                          <tr>
                            <th>
                              &nbsp;
                            </th>
                            <th>
                              1 sao
                            </th>
                            <th>
                              2 sao
                            </th>
                            <th>
                              3 sao
                            </th>
                            <th>
                              4 sao
                            </th>
                            <th>
                              5 sao
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              Chất lượng
                            </td>
                            <td>
                              <input type="radio" name="quality" value="Blue"/>
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Gía
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Gía trị
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <div class="form-row">
                            <label class="lebel-abs">
                              Tên của bạn
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="text" name="" class="input namefild" required>
                          </div>
                          <div class="form-row">
                            <label class="lebel-abs">
                              Email của bạn
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="email" name="" class="input emailfild" required>
                          </div>                          
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="form-row">
                            <label class="lebel-abs">
                              Nhận xét của bạn
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <textarea class="input textareafild" name="" rows="4" required>
                            </textarea>
                          </div>
                          <div class="form-row">
                            <button class="button" type="submit">Submit</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <script type="text/javascript">
                    $(document).ready(function(){
                      $('#danhgia').submit(function(){
                        alert("Cám ơn bạn đã đánh giá sản phẩm");
                        location.reload();
                      });
                    });
                  </script>>
                  <div class="tab-content" >
                    <div class="review">
                      <p class="rating">
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star-half-o gray">
                        </i>
                        <i class="fa fa-star-o gray">
                        </i>
                      </p>
                      <h5 class="reviewer">
                        Tên người đánh giá
                      </h5>
                      <p class="review-date">
                        Date: 26-12-2017
                      </p>
                      <p>
                        Gía cả hợp lý, chất lượng tốt.
                      </p>
                    </div>
                    <div class="review">
                      <p class="rating">
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star-half-o gray">
                        </i>
                        <i class="fa fa-star-o gray">
                        </i>
                      </p>
                      <h5 class="reviewer">
                        Tên người đánh giá
                      </h5>
                      <p class="review-date">
                        Date: 26-12-2017
                      </p>
                      <p>
                        Shop nhanh lấy thêm hàng đi ạ. Mẫu đẹp quá!!!!
                      </p>
                    </div>
                  </div>
                  <div class="tab-content" id="tags">
                    <div class="tag">
                      Thêm từ khóa : 
                      <input type="text" name="">
                      <input type="submit" value="Tag">
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div id="productsDetails" class="hot-products">
                <h3 class="title">
                  Sản phẩm
                  <strong>
                    Hot
                  </strong>
                </h3>
                <div class="control">
                  <a id="prev_hot" class="prev" href="#">
                    &lt;
                  </a>
                  <a id="next_hot" class="next" href="#">
                    &gt;
                  </a>
                </div>
                <ul id="hot">
                   <li>
                        <div class="row">
                            <?php 
                                    $pr=App\Product::orderBy('productID','desc')->limit(4)->get();
                                    for($i=0;$i<count($pr);$i++){
                                 ?>
                           <div class="col-md-3 col-sm-6">
                              <div class="products">
                                
                                 <div class="offer">Mới</div>
                                 <div class="thumbnail"><a href="details={{$pr[$i]['productID']}}"><img src="{{$pr[$i]['pictures']}}" alt="Product Name"></a></div>
                                 <div class="productname">{{$pr[$i]['productname']}}</div>
                                 <h4 class="price">${{$pr[$i]['price']}}</h4>                                 
                              </div>
                           </div> 
                           <?php } ?>
                        </div>
                     </li>
                     <li>
                        <div class="row">
                            <?php 
                     
                                for($i=4;$i<count($pr);$i++){
                           ?>
                           <div class="col-md-3 col-sm-6">
                              <div class="products">
                                
                                 <div class="offer">new</div>
                                 <div class="thumbnail"><a href="details"><img src="{{$pr[$i]['pictures']}}" alt="Product Name"></a></div>
                                 <div class="productname">{{$pr[$i]['productname']}}</div>
                                 <h4 class="price">${{$pr[$i]['price']}}</h4>
                                 <div class="button_group"><button class="button add-cart" type="button">Add To Cart</button><button class="button compare" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                              </div>
                           </div> 
                           <?php } ?>
                        </div>
                     </li>
                </ul>
              </div>
              <div class="clearfix">
              </div>
            </div>
            <div class="col-md-3">
              <div class="special-deal leftbar">
                <h4 class="title">
                  <strong>
                    Ưu đãi 
                  </strong>
                   Đặc biệt
                </h4>
                @foreach($pro_category as $pro)                
                <div class="special-item">
                  <div class="product-image">
                    <a href="/details={{$pro->productID}}">
                      <img src="{{$pro->pictures}}" alt="">
                    </a>
                  </div>
                  <div class="product-info">
                    <p>
                      {{$pro->productname}}
                    </p>
                    <h5 class="price">
                      ${{$pro->price}}
                    </h5>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="clearfix">
              </div>
              <div class="product-tag leftbar">
                <h3 class="title">
                  <strong>
                    Thẻ
                  </strong>
                   Sản Phẩm
                </h3>
                <ul>
                  <li>
                    <a href="#">
                      Aó khoác đẹp
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Sale lớn
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Mẫu mới
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      FlatShop
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Chất liệu đẹp
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Gía rẻ
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Cửa hàng FlatShop
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Hàng mới về
                    </a>
                  </li>
                </ul>
              </div>
              <div class="clearfix">
              </div>
              <div class="get-newsletter leftbar">
                <h3 class="title">
                  Nhận
                  <strong>
                    bản tin
                  </strong>
                </h3>
                <p>
                  Các loại mặt hàng mới về.
                </p>
                <form>
                  <input class="email" type="text" name="" placeholder="Email của bạn...">
                  <input class="submit" type="submit" value="Gửi">
                </form>
              </div>
              <div class="clearfix">
              </div>
              <div class="fbl-box leftbar">
                <h3 class="title">
                  Facebook
                </h3>
                <span class="likebutton">
                  <a href="#">
                    <img src="images/fblike.png" alt="">
                  </a>
                </span>
                <p>
                  12k người thích Flat Shop.
                </p>
                <ul>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                </ul>
                <div class="fbplug">
                  <a href="#">
                    <span>
                      <img src="images/fbicon.png" alt="">
                    </span>
                    Liên kết với Facebook
                  </a>
                </div>
              </div>
              <div class="clearfix">
              </div>
            </div>
          </div>
          <div class="clearfix">
          </div>
          <div class="our-brand">
            <h3 class="title" style="font-family: sans-serif;">
              <strong>
                Nhãn hiệu 
              </strong>
              của chúng tôi
            </h3>
            <div class="control">
              <a id="prev_brand" class="prev" href="#">
                &lt;
              </a>
              <a id="next_brand" class="next" href="#">
                &gt;
              </a>
            </div>
            <ul id="braldLogo">
              <li>
                <ul class="brand_item">
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/themeforest.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/photodune.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/activeden.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <ul class="brand_item">
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/themeforest.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/photodune.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/activeden.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      @include('footer');    
    </div>
    <script type="text/javascript">
         $(document).ready(function(){            
            $.ajaxSetup({
               headers: {
                  'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
               }
            });            
         });
      </script>
    <!-- Bootstrap core JavaScript==================================================-->    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script defer src="js/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js">
    </script>
    <script type="text/javascript" src='js/jquery.elevatezoom.js'>
    </script>
    <script type="text/javascript" src="js/script.min.js" >
    </script>
    <script type="text/javascript" src="js/add-to-cart.js" >
    </script>
  </body>
</html>