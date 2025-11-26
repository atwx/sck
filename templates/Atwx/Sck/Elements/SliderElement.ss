<section class="section--SliderElement $BackgroundColor $ElementDecoration">
    <div class="section_content">
        <div class="slider<% if $WidthLevel %> slider--$WidthLevel<% end_if %>">
            <% if $Content %>
                <div class="element-content">
                    <div class="section_text">
                        <% if $Title %>
                            <h2
                                class="slider-title"
                                style="color: $TitleColor;">
                                $Title
                            </h2>
                        <% end_if %>
                        $Content
                        <% if $Button %>
                            <% include Atwx/Sck/Includes/Button Link=$Button %>
                        <% end_if %>
                    </div>
                    <div
                        class="section_swiper swiper swiper-arrows--$ArrowsPosition"
                        data-behaviour="swiper"
                        data-autoplay="$Autoplay"
                        data-autoplay-delay="$AutoplayDelay"
                        data-effect="$TransitionEffect"
                        data-pagination="$ShowPagination"
                        data-pagination-position="$PaginationPosition"
                    >
                        <div class="swiper-wrapper">
                            <% loop $PhotoGalleryImages %>
                                <div class="swiper-slide">
                                    <% if $Image %>
                                        <div class="slider-image" style="position:relative;">
                                            $Image.FocusFill(1200,800)
                                            <div class="slider-overlay" style="background:rgba(0,0,0,{$Up.OverlayOpacity});position:absolute;top:0;left:0;width:100%;height:100%;"></div>
                                        </div>
                                    <% end_if %>
                                    <% if $Caption %>
                                        <p class="caption">$Caption</p>
                                    <% end_if %>
                                </div>
                            <% end_loop %>
                        </div>
                        <% if $ShowPagination %>
                            <div class="swiper-pagination swiper-pagination--$PaginationPosition"></div>
                        <% end_if %>
                        <% if $ShowArrows %>
                            <div class="swiper-button-prev" style="color: $TitleColor;"></div>
                            <div class="swiper-button-next" style="color: $TitleColor;"></div>
                        <% end_if %>
                    </div>
                </div>
            <% else %>
                <% if $Title %>
                    <h2
                        class="slider-title"
                        style="color: $TitleColor;">
                        $Title
                    </h2>
                <% end_if %>
                <div
                    class="swiper swiper-arrows--$ArrowsPosition"
                    data-behaviour="swiper"
                    data-autoplay="$Autoplay"
                    data-autoplay-delay="$AutoplayDelay"
                    data-effect="$TransitionEffect"
                    data-pagination="$ShowPagination"
                    data-pagination-position="$PaginationPosition"
                >
                    <div class="swiper-wrapper">
                        <% loop $PhotoGalleryImages %>
                            <div class="swiper-slide">
                                <% if $Image %>
                                    <div class="slider-image" style="position:relative;">
                                        $Image.FocusFill(1200,800)
                                        <div class="slider-overlay" style="background:rgba(0,0,0,{$Up.OverlayOpacity});position:absolute;top:0;left:0;width:100%;height:100%;"></div>
                                    </div>
                                <% end_if %>
                                <% if $Caption %>
                                    <p class="caption">$Caption</p>
                                <% end_if %>
                            </div>
                        <% end_loop %>
                    </div>
                    <% if $ShowPagination %>
                        <div class="swiper-pagination swiper-pagination--$PaginationPosition"></div>
                    <% end_if %>
                    <% if $ShowArrows %>
                        <div class="swiper-button-prev" style="color: $TitleColor;"></div>
                        <div class="swiper-button-next" style="color: $TitleColor;"></div>
                    <% end_if %>
                </div>
            <% end_if %>
        </div>
    </div>
</section>
