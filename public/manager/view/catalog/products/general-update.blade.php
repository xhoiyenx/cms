<div class="row">
  <div class="col-md-9">

    <div class="panel panel-inverse">
      <div class="panel-body">

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Name:</label>
              {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description:</label>
              {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Use Stock Management:</label>
              {{ Form::select('use_stock', ['n' => 'No', 'y' => 'Yes'], null, ['class' => 'form-control', 'style' => 'width:100%']) }}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Stock Quantity:</label>
              {{ Form::text('qty_stock', null, ['class' => 'form-control']) }}
            </div>
          </div>

        </div>
        
      </div>
    </div>

    <div class="panel panel-inverse">
      <div class="panel-body form-horizontal form-set">

        <div class="form-group">
          <label class="col-md-3 control-label">SKU</label>
          <div class="col-md-9">
            {{ Form::text('sku', null, ['class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">Price</label>
          <div class="col-md-9">
            {{ Form::text('price', null, ['class' => 'form-control']) }}
          </div>
        </div>

      </div>
    </div>    
    

  </div>  
  <div class="col-md-3">
    <!-- CATEGORIES -->
    <div class="panel panel-primary">
      <ul class="panel-options">
        <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
      </ul>
      <div class="panel-heading">
        <h4 class="panel-title">Categories</h4>
      </div>
      <div class="panel-body max300">

        {!! $tree !!}
        
      </div>
    </div>

    <div class="panel panel-primary">
      <ul class="panel-options">
        <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
      </ul>
      <div class="panel-heading">
        <h4 class="panel-title">Attributes</h4>
      </div>
      <div class="panel-body max300">
        {!! $attr !!}
      </div>
    </div>    

    <div class="panel panel-inverse-full">
      <ul class="panel-options">
        <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
      </ul>
      <div class="panel-heading">
        <h3 class="panel-title">Media</h3>
      </div>
      <div class="panel-body">
        <div class="panel-actions">
          <a href="{{ route('manager.catalog.product.media') }}" data-id="{{ $form->id }}" class="btn btn-success btn-quirk btn-form">upload media</a>
        </div>
        <div class="row filemanager">
        </div>

      </div>
    </div>
    

  </div>
</div>
