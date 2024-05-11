
@extends('frontend.main_master')

@section('content')

<link
href="https://www.seagate.com/content/dam/seagate/migrated-assets/ww/universal/css/stx-bootstrap-min.css?v=20221012"
rel="stylesheet"
/>
<link
href="https://www.seagate.com/content/dam/seagate/migrated-assets/ww/universal/css/stx-bootstrap-responsive-min.css"
rel="stylesheet"
type="text/css"
/>

<link
href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css"
rel="stylesheet"
type="text/css"
/>
<link
href="https://www.seagate.com/content/dam/seagate/migrated-assets/www-content/storage-calculator/files/calculator.css"
rel="stylesheet"
type="text/css"
/>
<link
href="https://www.seagate.com/content/dam/seagate/migrated-assets/www-content/storage-calculator/files/calculator-custom.css"
rel="stylesheet"
type="text/css"
/>


<div id="container " class="container cmp-container">
    <div class="codeblock">
      <div id="content-row-background" class="content-row clearfix">
        <div class="container">
          <div class="row-fluid">
            <div class="span6">
              <div class="headerText">
                <h1 class="whiteText">
                  Surveillance Storage Calculator
                </h1>
                <br />
                <h4 class="whiteText">
                  Input your surveillance technology specifications
                  to estimate the necessary storage space needed to
                  support your unique environment.
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        id="content-row-d25a9e2ce5643610VgnVCM100000ef41090a____-1-0"
        class="content-row clearfix"
      >
        <div class="content-row-1-column">
          <div class="container calculator-container">
            <div class="row-fluid">
              <div class="span7">
                <div class="storage-calculator clearfix">
                  <div class="sc-row clearfix">
                    <label>Number of Cameras</label>
                    <input
                      class="hidden-phone"
                      type="text"
                      id="cameraSlide"
                      name="cameras"
                      data-provide="slider"
                      data-slider-min="1"
                      data-slider-max="25"
                      data-slider-step="1"
                      data-slider-value="12"
                      data-slider-tooltip="show"
                      data-slider-handle="custom"
                    />
                    <div class="btn-group">
                      <select id="cameraSelectData">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                      </select>
                      <input
                        class="slideEdit"
                        id="cameraSlideData"
                        value="12"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        type="text"
                      />
                      <span class="icon-dropdown"></span>
                    </div>
                  </div>
                  <div class="sc-row clearfix">
                    <label>Frames per second</label>
                    <input
                      class="hidden-phone"
                      type="text"
                      id="frameSlide"
                      name="frames"
                      data-provide="slider"
                      data-slider-min="1"
                      data-slider-max="30"
                      data-slider-step="1"
                      data-slider-value="15"
                      data-slider-tooltip="show"
                      data-slider-handle="custom"
                    />
                    <div class="btn-group">
                      <select id="select01">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                      </select>
                      <input
                        class="slideEdit"
                        id="frameSlideData"
                        value="15"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        type="text"
                      />
                      <span class="icon-dropdown"></span>
                    </div>
                  </div>
                  <div class="sc-row clearfix">
                    <label>Hours per day</label>
                    <input
                      class="hidden-phone"
                      type="text"
                      id="hourSlide"
                      name="hours"
                      data-provide="slider"
                      data-slider-min="1"
                      data-slider-max="24"
                      data-slider-step="1"
                      data-slider-value="12"
                      data-slider-tooltip="show"
                      data-slider-handle="custom"
                    />
                    <div class="btn-group">
                      <select id="select01">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                      </select>
                      <input
                        class="slideEdit"
                        id="hourSlideData"
                        value="12"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        type="text"
                      />
                      <span class="icon-dropdown"></span>
                    </div>
                  </div>
                  <div class="sc-row clearfix">
                    <label>Number of Days Stored</label>
                    <input
                      class="hidden-phone"
                      type="text"
                      id="daySlide"
                      name="days"
                      data-provide="slider"
                      data-slider-min="1"
                      data-slider-max="31"
                      data-slider-step="1"
                      data-slider-value="15"
                      data-slider-tooltip="show"
                      data-slider-handle="custom"
                    />
                    <div class="btn-group">
                      <select id="select01">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                      </select>
                      <input
                        class="slideEdit"
                        id="daySlideData"
                        value="15"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        type="text"
                      />
                      <span class="icon-dropdown"></span>
                    </div>
                  </div>
                  <div class="sc-row sc-block clearfix">
                    <label
                      >Resolution
                      <a
                        href="#"
                        class="hidden-phone"
                        onclick="return false;"
                        id="resolutionTip"
                        data-toggle="popover"
                        title=""
                        data-placement="top"
                        data-trigger="focus"
                        data-content="Resolution is determined by the number of pixels captured by the camera."
                        ><img
                          src="https://www.seagate.com/content/dam/seagate/migrated-assets/www-content/storage-calculator/images/question-icon.png"
                          alt=""
                      /></a>
                      <div class="accordion-group">
                        <div class="accordion-heading">
                          <a
                            class="accordion-toggle"
                            data-toggle="collapse"
                            href="#collapseOne"
                          >
                            <img
                              src="https://www.seagate.com/content/dam/seagate/migrated-assets/www-content/storage-calculator/images/question-icon.png"
                              alt=""
                            />
                          </a>
                        </div>
                        <div
                          id="collapseOne"
                          class="accordion-body collapse"
                        >
                          <div class="accordion-inner">
                            Resolution is determined by the number
                            of pixels captured by the camera.
                          </div>
                        </div>
                      </div>
                    </label>
                    <input
                      class="hidden-phone"
                      type="text"
                      id="resolutionSlide"
                      name="resolution"
                      data-provide="slider"
                      data-slider-ticks="[3, 4, 5, 6, 7, 8]"
                      data-slider-ticks-labels='["960", "720p", "1080p", "3MP", "5MP", "8MP/4K"]'
                      data-slider-min="1"
                      data-slider-max="3"
                      data-slider-step="1"
                      data-slider-value="5"
                      data-slider-tooltip="hide"
                      data-slider-handle="custom"
                    />g
                    <input
                      style="margin-bottom: 37px"
                      class="slideEdit hidden-phone"
                      id="resolutionSlideData"
                      type="text"
                      value="1080p"
                      disabled
                    />
                    <div class="myRadio radio-resolution">
                      <input
                        type="radio"
                        name="resolution"
                        value="960"
                        id="r_960"
                      /><label class="rTab" for="r_960">960</label>
                      <input
                        type="radio"
                        name="resolution"
                        value="720p"
                        id="r_720p"
                      /><label class="rTab" for="r_720p"
                        >720p</label
                      >
                      <input
                        type="radio"
                        name="resolution"
                        value="1080p"
                        checked
                        id="r_1080p"
                      /><label class="rTab" for="r_1080p"
                        >1080p</label
                      >
                      <input
                        type="radio"
                        name="resolution"
                        value="3MP"
                        id="r_3MP"
                      /><label class="rTab" for="r_3MP">3MP</label>
                      <input
                        type="radio"
                        name="resolution"
                        value="5MP"
                        id="r_5MP"
                      /><label class="rTab" for="r_5MP">5MP</label>
                      <input
                        type="radio"
                        name="resolution"
                        value="8MP/4K"
                        id="r_8MP/4K"
                      /><label class="rTab" for="r_8MP/4K"
                        >8MP/4K</label
                      >
                    </div>
                  </div>
                  <div class="sc-row sc-block clearfix">
                    <label
                      >Video Quality
                      <a
                        href="#"
                        class="hidden-phone"
                        id="videoTip"
                        data-toggle="popover"
                        data-placement="top"
                        data-trigger="focus"
                        title=""
                        data-content="Regardless of the codec used (MJPEG, JPEG2000, MPEG-4, H.264), all IP cameras offer quality levels, often called 'compression' or 'quantization'. Video quality is determined based on bandwidth and compression settings. Lower bandwidth and greater compression equates to lower video quality."
                        ><img
                          src="https://www.seagate.com/content/dam/seagate/migrated-assets/www-content/storage-calculator/images/question-icon.png"
                          alt=""
                      /></a>
                      <div class="accordion-group">
                        <div class="accordion-heading">
                          <a
                            class="accordion-toggle"
                            data-toggle="collapse"
                            href="#collapseTwo"
                          >
                            <img
                              src="https://www.seagate.com/content/dam/seagate/migrated-assets/www-content/storage-calculator/images/question-icon.png"
                              alt=""
                            />
                          </a>
                        </div>
                        <div
                          id="collapseTwo"
                          class="accordion-body collapse"
                        >
                          <div class="accordion-inner">
                            Regardless of the codec used (MJPEG,
                            JPEG2000, MPEG-4, H.264), all IP cameras
                            offer quality levels, often called
                            'compression' or 'quantization'. Video
                            quality is determined based on bandwidth
                            and compression settings. Lower
                            bandwidth and greater compression
                            equates to lower video quality.
                          </div>
                        </div>
                      </div>
                    </label>
                    <input
                      class="hidden-phone"
                      type="text"
                      id="qualitySlide"
                      name="quality"
                      data-provide="slider"
                      data-slider-ticks="[1,2,3]"
                      data-slider-ticks-labels='["Low", "Medium", "High"]'
                      data-slider-min="1"
                      data-slider-max="3"
                      data-slider-step="1"
                      data-slider-value="2"
                      data-slider-tooltip="hide"
                      data-slider-handle="custom"
                    />
                    <input
                      style="margin-bottom: 37px"
                      class="slideEdit hidden-phone"
                      id="qualitySlideData"
                      type="text"
                      value="Medium"
                      disabled
                    />
                    <div class="myRadio radio-quality">
                      <input
                        type="radio"
                        name="quality"
                        value="Low"
                        id="q_low"
                      /><label class="rTab" for="q_low">Low</label>
                      <input
                        type="radio"
                        name="quality"
                        value="Medium"
                        checked
                        id="q_medium"
                      /><label class="rTab" for="q_medium"
                        >Medium</label
                      >
                      <input
                        type="radio"
                        name="quality"
                        value="High"
                        id="q_high"
                      /><label class="rTab" for="q_high"
                        >High</label
                      >
                    </div>
                  </div>
                  <div class="sc-row sc-block clearfix">
                    <label style="display: inline-block"
                      >Compression Type</label
                    >
                    <div class="myRadio">
                      <input
                        type="radio"
                        name="compType"
                        value="MJPEG"
                        checked
                        id="mjpeg"
                      /><label class="rTab" for="mjpeg"
                        >MJPEG</label
                      >
                      <input
                        type="radio"
                        name="compType"
                        value="264"
                        id="h264"
                      /><label class="rTab" for="h264">H.264</label>
                      <input
                        type="radio"
                        name="compType"
                        value="265"
                        id="h265"
                      /><label class="rTab" for="h265">H.265</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="span5">
                <div class="required-storage-space">
                  <h2>Required Storage Space</h2>
                  <div id="storageCalc">
                    <span>0000000</span> <sup>*</sup>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('js')
  <script src="https://www.seagate.com/etc.clientlibs/seagate/clientlibs/clientlib-legacy.min.a827a965f65f619b277fb6911d9e1a47.js"></script>


  <!-- Begin insert footerCode from Channel Info Child -->
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js"
    type="text/javascript"
  ></script>
  <script
    src="https://www.seagate.com/content/dam/seagate/migrated-assets/www-content/storage-calculator/files/storage-calc.js"
    type="text/javascript"
  ></script>

  <script>
    $("#videoTip").popover();

    $("#resolutionTip").popover();
  </script>
  <!-- End insert footerCode from Channel Info Child -->

  <script src="https://www.seagate.com/content/dam/seagate/assets/system/patch/patch.js"></script>
  @endpush

@endsection
