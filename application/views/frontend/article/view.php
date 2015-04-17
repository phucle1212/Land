<!-- banner -->
<?php if(isset($data['namecategory']) && count($data['namecategory'])){ ?>
<?php foreach ($data['namecategory'] as $key => $val) { ?>
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="#">Tin tức</a> / <?php echo $val['title']; ?></span>
    <h2>Tin tức</h2>
</div>
</div>
<!-- banner -->
<?php } ?>
<?php } ?>

<!-- nav -->
<nav class="navigation">
  <?php if(isset($data['category']) && count($data['category'])){ ?>
  <?php foreach ($data['category'] as $key => $val) { ?>
  <ul class="main">
    <li class="main">
      <a class="main" name="group" href="<?php echo base_url(); ?>frontend/article/view/<?php echo $val['id']; ?>" title="<?php echo $val['title']; ?>"><?php echo $val['title']; ?></a>
      <!-- <ul class="item">
        <li class="item">
          <a href="#" title="Cấu hình hệ thống">Cấu hình</a>
        </li>
      </ul> -->
    </li>
  </ul>
  <?php } ?>
  <?php } else { ?>
    <td class="last" colspan="9"><p>Không có dữ liệu</p></td>
  <?php } ?>
</nav>
<!-- end nav -->


<div class="container">
<div class="spacer blog">
<div class="row">
  <div class="col-lg-8 col-sm-12 ">

    <?php if(isset($data['item']) && count($data['item'])){ ?>
    <?php foreach ($data['item'] as $key => $val) { ?>
    <!-- blog list -->
    <div class="row">
                              <div class="col-lg-4 col-sm-4 "><a href="blogdetail.php" class="thumbnail"><img src="<?php echo $val['image']; ?>" alt="Hình ảnh"></a></div>
                              <div class="col-lg-8 col-sm-8 ">
                              <h3><a href="<?php echo base_url(); ?>frontend/article/index/<?php echo $val['id']; ?>"><?php echo $val['title']; ?></a></h3>
                              <div class="info">Ngày cập nhật: <?php echo $val['created']; ?></div>                                               
                              <p class="item_description"><?php echo $val['description']; ?></p>
                              <a href="<?php echo base_url(); ?>frontend/article/index/<?php echo $val['id']; ?>" class="more">Đọc tiếp</a>
                              </div>
    </div>
    <!-- blog list -->
    <?php } ?>
    <?php } else { ?>
      <td class="last" colspan="9"><p>Không có dữ liệu</p></td>
    <?php } ?>

  </div>
  <div class="col-lg-4 visible-lg">

  <!-- tabs -->
  <div class="tabbable" style="margin: 0px 0px 0px 26px;">
              <ul class="nav nav-tabs">
                <li class=""><a href="#tab1" data-toggle="tab">Recent Post</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Most Popular</a></li>
                <li class="active"><a href="#tab3" data-toggle="tab">Most Commented</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane" id="tab1">
                  <ul class="list-unstyled">
                  <li>
                  <h5><a href="blogdetail.php">Real estate marketing growing</a></h5>
                            <div class="info">Posted on: Jan 20, 2013</div>  
                            </li>
                             <li>
                  <h5><a href="blogdetail.php">Real estate marketing growing</a></h5>
                            <div class="info">Posted on: Jan 20, 2013</div>  
                            </li>
                             <li>
                  <h5><a href="blogdetail.php">Real estate marketing growing</a></h5>
                            <div class="info">Posted on: Jan 20, 2013</div>  
                            </li>
                            </ul>
                </div>
                <div class="tab-pane" id="tab2">
                <ul  class="list-unstyled">
                  <li>
                  <h5><a href="blogdetail.php">Market update on new apartments</a></h5>
                            <div class="info">Posted on: Jan 20, 2013</div>  
                            </li>

                  <li>
                  <h5><a href="blogdetail.php">Market update on new apartments</a></h5>
                            <div class="info">Posted on: Jan 20, 2013</div>  
                            </li>

                  <li>
                  <h5><a href="blogdetail.php">Market update on new apartments</a></h5>
                            <div class="info">Posted on: Jan 20, 2013</div>  
                            </li>
                            </ul>
                </div>
                <div class="tab-pane active" id="tab3">
                <ul class="list-unstyled">      
                            <li>
                  <h5><a href="blogdetail.php">Creative business to takeover the market</a></h5>
                            <div class="info">Posted on: Jan 20, 2013</div>  
                            </li>
                            
                            <li>
                  <h5><a href="blogdetail.php">Creative business to takeover the market</a></h5>
                            <div class="info">Posted on: Jan 20, 2013</div>  
                            </li>
                            </ul>
                </div>
              </div>
              
              
              
            </div>
  <!-- tabs -->

  </div>
</div>
</div>
</div>

