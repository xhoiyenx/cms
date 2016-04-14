<h1 class="manager-title clearfix text-uppercase" style="padding-bottom: 5px; font-size: 12px">
  Attributes
</h1>
<div class="panel">
<table class="table table-bordered table-hover table-primary">
  <tbody class="ajax-attributes">
  </tbody>
</table>
</div>
<h1 class="manager-title clearfix text-uppercase" style="padding-bottom: 5px; font-size: 12px">
  Variations
  <div class="btn-toolbar pull-right">
    <a class="btn btn-primary btn-quirk btn-form" data-id="{{ $form->id }}" href="{{ route('manager.catalog.product.variation') }}">Add New</a>
  </div>  
</h1>
<div class="panel ajax-variations">
<table class="table table-bordered table-hover table-primary">
  <thead>
    <tr>
      <th width="80%">name</th>
      <th width="20%" class="text-center">action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>