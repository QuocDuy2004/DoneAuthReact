@extends('Admin.Layout.App')

@section('title', 'Cài đặt hiệu ứng')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4">
                <h1 class="page-title fw-semibold fs-18 mb-0">Cài đặt hiệu ứng</h1>
                <div class="ms-md-1 ms-0">
                    <!-- Optional actions or buttons -->
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start:: Content -->
            <div class="row">
                <!-- General Settings Card -->
                <div class="col-md-12">
                    <div class="card shadow-sm border-light">
                        <div class="card-body">
                            <form action="https://localhost/admin/website/effect" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <!-- Logo -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="logo" class="form-label">Logo</label>
                                            <input type="text" class="form-control" value="" id="logo" name="logo">
                                        </div>
                                    </div>
                            
                                    <!-- Favicon (Large) -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="favicon" class="form-label">Favicon (Large)</label>
                                            <input type="text" class="form-control" value="" id="favicon" name="favicon">
                                        </div>
                                    </div>
                            
                                    <!-- Favicon (Small) -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="logo_mini" class="form-label">Favicon (Small)</label>
                                            <input type="text" class="form-control" value="/assets/images/logo.jpg" id="logo_mini" name="logo_mini">
                                        </div>
                                    </div>
                            
                                    <!-- Image SEO -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="image_seo" class="form-label">Image SEO</label>
                                            <input type="text" class="form-control" value="" id="image_seo" name="image_seo">
                                        </div>
                                    </div>
                            
                                    <!-- Effect Selection -->
                                    <div class="col-md-12">
                                        <label for="effect" class="form-label">Effect</label>
                                        <div class="form-group">
                                            <!-- Radio button for Effect 1 -->
                                            <input type="radio" name="effect" id="effect_1" value="1" onchange="showVideo(1)">
                                            <label for="effect_1">Effect 1</label>
                                            <div id="video_1" style="display:none;">
                                                <video width="320" height="240" controls>
                                                    <source src="/path/to/video1.mp4" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <!-- Radio button for Effect 2 -->
                                            <input type="radio" name="effect" id="effect_2" value="2" onchange="showVideo(2)">
                                            <label for="effect_2">Effect 2</label>
                                            <div id="video_2" style="display:none;">
                                                <video width="320" height="240" controls>
                                                    <source src="/path/to/video2.mp4" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <!-- Radio button for Effect 3 -->
                                            <input type="radio" name="effect" id="effect_3" value="3" onchange="showVideo(3)">
                                            <label for="effect_3">Effect 3</label>
                                            <div id="video_3" style="display:none;">
                                                <video width="320" height="240" controls>
                                                    <source src="/path/to/video3.mp4" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="text-end mt-4">
                                    <button class="btn btn-primary" type="submit">Cập Nhật</button>
                                </div>
                            </form>
                            
                            <script>
                                function showVideo(effectId) {
                                    // Hide all videos
                                    document.getElementById('video_1').style.display = 'none';
                                    document.getElementById('video_2').style.display = 'none';
                                    document.getElementById('video_3').style.display = 'none';
                            
                                    // Show the selected video
                                    document.getElementById('video_' + effectId).style.display = 'block';
                                }
                            </script>
                            
                        </div>
                    </div>
                </div>
                <!-- General Settings Card End -->
            </div>
            <!-- Start:: Content Close -->
        </div>
    </div>
@endsection
