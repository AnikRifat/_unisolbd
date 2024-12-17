@php
    $categories=App\Models\Category::orderBy('category_name',"ASC")->get();
@endphp


<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> 
      Categories
    </div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">

        @foreach ($categories as $category)
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          {{ $category->category_name }}          
        </a>
          <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
              <div class="row">

                @php
                $subcategory=App\Models\SubCategory::where('category_id',$category->id)->get();
              @endphp

                @foreach ($subcategory as $subcat)
                <div class="col-sm-12 col-md-3">  
                  <a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}">          
                    <h2 class="title">
                    @if (session()->get('language')=='hindi')
                    {{ $subcat->subcategory_name_hin }}    
                    @else
                    {{ $subcat->subcategory_name }}
                    @endif
                    </h2>
                  </a> 
                  <ul class="links list-unstyled">


                @php
                $subsubcategory=App\Models\SubSubCategory::where('subcategory_id',$subcat->id)->get();
                @endphp

                @foreach ($subsubcategory as $subsubcat )
                <li>
                    <a href="{{ url('subsubcategory/product/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_en) }}">
                    @if(session()->get('language')=='hindi')
                    {{ $subsubcat->subsubcategory_name_hin}}
                    @else
                    {{ $subsubcat->subsubcategory_name_en }}
                    @endif
                    </a>
                </li>
                @endforeach
                  </ul>
                </div>
                <!-- /.col -->
                @endforeach
              </div>
              <!-- /.row --> 
            </li>
            <!-- /.yamm-content -->
          </ul>  
        @endforeach
     
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->
      </ul>
      <!-- /.nav --> 
    </nav>
    <!-- /.megamenu-horizontal --> 
  </div>
  <!-- /.side-menu --> 