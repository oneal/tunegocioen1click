@extends('web/layouts/master')

@section('styles')
@endsection

@section('content')
    <section>
        <div class="container" style="margin-top: 100px">
            <div class="row">
                <div class="col-md-9 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($post->image) }}'); width: 100%; height: 350px; display: block">
                                <div class="bg-overlay" style="display: block">
                                    <div class="bg-overlay-content dark">
                                        <h2 class="title-post">{{ $post->name }}</h2>
                                    </div>
                                    <div class="bg-overlay-bg dark"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-5">
                        <div class="col-sm-12">
                            <?php echo $post->description; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="pro-bot-shar">
                                <h4>Comparte este post</h4>

                                <?php
                                $blog_name_url = $post->name_slug;

                                $fb_url = config('app.url'). "/blog/post/".$blog_name_url."?src=facebook";  //URL Blog Detail  Facebook Link
                                $fb_link = urlencode($fb_url);

                                $twitter_url = config('app.url'). "/blog/post/".$blog_name_url."?src=twitter";  //URL Blog Detail Twitter Link
                                $twitter_link = urlencode($twitter_url);

                                $linkedin_url = config('app.url'). "/blog/post/".$blog_name_url."?src=linkedin";  //URL Blog Detail Linkedin Link
                                $linkedin_link = urlencode($linkedin_url);

                                $whatsapp_url = config('app.url'). "/blog/post/".$blog_name_url."?src=whatsapp";  //URL Blog Detail Whatsapp Link
                                $whatsapp_link = urlencode($whatsapp_url);

                                ?>

                                <ul>
                                    <li>
                                        <div class="sh-pro-shar sh-pro-face">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $fb_url; ?>&quote=<?php echo $post->name; ?>"><img src="{{ Voyager::image('social/3.png')}} " title="<?php echo $post->name; ?>" alt="<?php echo $post->name; ?>"> Facebook</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sh-pro-shar sh-pro-twi">
                                            <a target="_blank" href="http://twitter.com/share?text=<?php echo $blog_name_url; ?>&url=<?php echo $twitter_link; ?>"><img src="{{ Voyager::image('social/2.png') }}" title="<?php echo $post->name; ?>" alt="<?php echo $post->name; ?>"> Twitter</a>
                                        </div>
                                    </li>
                                    <?php /*<li>
                                        <div class="sh-pro-shar sh-pro-link">
                                            <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $linkedin_link; ?>"><img src="<?php echo $slash; ?>images/social/1.png" title="<?php echo $blog_name_url; ?>" alt="<?php echo $blog_name_url; ?>"> Linkedin</a>
                                        </div>
                                    </li>*/?>
                                    <li>
                                        <div class="sh-pro-shar sh-pro-what">
                                            <a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $whatsapp_link; ?>" data-action="share/whatsapp/share"><img src="{{ Voyager::image('social/6.png') }}" title="<?php echo $post->name; ?>" alt="<?php echo $post->name; ?>"> WhatsApp</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-12">
                    @if(isset($postAd))
                        <a href="{{$postAd->website}}" target="_blank" class="mb-sm-5" style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($postAd->image)}}'); width: 100%; height: 240px; display: block;"></a>
                    @else
                        <div class="mb-sm-5" style="background-size: cover; background-position: center; background-color: #cccccc; width: 100%; height: 240px; display: block;"></div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
