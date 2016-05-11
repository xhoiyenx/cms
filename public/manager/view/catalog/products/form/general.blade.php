<div class="row">
  <div class="col-md-9">

    <div class="panel">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Name: <span class="required">*</span></label>
              {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group nomargin">
              <label>Description:</label>
              {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
              {!! redactor('description') !!}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel">
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

        <div class="form-group">
          <label class="col-md-3 control-label">Stock Management</label>
          <div class="col-md-9">
            {{ Form::select('use_stock', ['n' => 'No', 'y' => 'Yes'], null, ['class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">Stock Quantity</label>
          <div class="col-md-9">
            {{ Form::text('qty_stock', null, ['class' => 'form-control']) }}
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

        {!! $categories !!}
        
      </div>
    </div>
  </div>
</div>