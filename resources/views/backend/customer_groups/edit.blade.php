@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
         <div class="col-12">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Edit Customer Group</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form method="POST" action="{{ route('customer-groups.update', $group->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label class="info-title">Name<span class="text-danger">*</span></label>
                  <input type="text" name="name" value="{{ old('name', $group->name) }}" class="form-control">
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="info-title">Discount<span class="text-danger">*</span></label>
                  <div id="rules-container">
                      @foreach(json_decode($group->rules, true) as $key => $value)
                      <div class="input-group mb-2">
                        <input type="text" name="rules[value][]" class="form-control form-control-sm" placeholder="Value" value="{{ $value }}">
                        <input type="number" name="rules[key][]" class="form-control form-control-sm" placeholder="Key" value="discount" hidden>
                          {{-- <div class="input-group-append">
                              <button type="button" class="btn btn-danger btn-remove-rule">-</button>
                          </div> --}}
                      </div>
                      @endforeach
                  </div>
                  {{-- <button type="button" class="btn btn-success btn-add-rule">Add Rule</button> --}}
                </div>
{{--
                <div class="form-group">
                  <label class="info-title">Status<span class="text-danger">*</span></label>
                  <input type="number" name="status" value="{{ old('status', $group->status) }}" class="form-control">
                  @error('status')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div> --}}

                <div class="form-group">
                  <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                </div>

              </form>
             </div>
           </div>
           <!-- /.box-body -->
           </div>
           <!-- /.box -->
         </div>
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.btn-add-rule').addEventListener('click', function () {
            var container = document.getElementById('rules-container');
            var row = document.createElement('div');
            row.classList.add('input-group', 'mb-2');
            row.innerHTML = `
                <input type="text" name="rules[key][]" class="form-control form-control-sm" placeholder="Key">
                <input type="text" name="rules[value][]" class="form-control form-control-sm" placeholder="Value">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger btn-remove-rule">-</button>
                </div>
            `;
            container.appendChild(row);
            row.querySelector('.btn-remove-rule').addEventListener('click', function () {
                container.removeChild(row);
            });
        });

        document.querySelectorAll('.btn-remove-rule').forEach(function (button) {
            button.addEventListener('click', function () {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            });
        });
    });
</script>
@endsection
