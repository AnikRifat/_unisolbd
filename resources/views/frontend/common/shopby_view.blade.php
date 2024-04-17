@php
    $category=App\Models\Category::orderBy('category_name',"ASC")->get();
@endphp


<div class="sidebar-widget wow fadeInUp">
    <h3 class="section-title">shop by</h3>
    <div class="widget-header">
      <h4 class="widget-title">Category</h4>
    </div>
    <div class="sidebar-widget-body">
      <div class="accordion">


        @foreach ($categories as $category)
        <div class="accordion-group">
            <div class="accordion-heading"> 
                <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed"> 
                    @if (session()->get('language')=='hindi')
                    {{ $category->category_name }}
                    @else
                    {{ $category->category_name }}
                    @endif
                </a> 
            </div>
            @php
                $subcategory=App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
            @endphp
            <!-- /.accordion-heading -->
            <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
              <div class="accordion-inner">
                <ul>
                    @foreach ($subcategory as $subcat)
                    <li>
                        <a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}">
                            @if (session()->get('language')=='hindi')
                            {{ $subcat->subcategory_name_hin }}
                            @else
                            {{ $subcat->subcategory_name }}
                            @endif
                        </a>
                    </li>
                    @endforeach
                  
                  
                </ul>
              </div>
              <!-- /.accordion-inner --> 
            </div>
            <!-- /.accordion-body --> 
          </div>
        @endforeach
       
        <!-- /.accordion-group -->
        
        
        
      </div>
      <!-- /.accordion --> 
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>