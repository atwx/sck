<div class="section section--CardSliderElement">
    <div class="section_content">
        <% if $SliderTitle %>
            <h2 class="hl2 section_title">$SliderTitle</h2>
        <% end_if %>
        <% if $IntroText %>
            <div class="section_intro_text">$IntroText</div>
        <% end_if %>
        <% if $Cards %>
            <div class="swiper cards-slider"
                data-behaviour="swiper"
                data-autoplay="$Autoplay"
                data-autoplay-delay="$AutoplaySpeed"
                data-loop="$Loop"
                data-effect="slide"
                data-pagination="$ShowDots"
                data-slidesperview="3"
                data-centeredslides="true">

                <div class="swiper-wrapper">
                    <% loop $Cards %>
                        <div class="swiper-slide card-slide $BackgroundColor">
                            <% if $BackgroundImage %>
                                <% if $Button %>
                                    <a href="$Button.URL" class="card-slide-image ignoreLinkPrefix" <% if $Button.OpenInNew %>target="_blank"<% end_if %>>
                                        <img src="$BackgroundImage.AbsoluteURL" alt="$Title" loading="lazy">
                                        <div class="card-slide-overlay"></div>
                                    </a>
                                <% else %>
                                    <div class="card-slide-image">
                                        <img src="$BackgroundImage.AbsoluteURL" alt="$Title" loading="lazy">
                                        <div class="card-slide-overlay"></div>
                                    </div>
                                <% end_if %>
                            <% else %>
                                <div class="card-slide-image"></div>
                            <% end_if %>

                            <div class="card-slide-content">
                                <% if $Title %>
                                <h3 class="card-slide-title">$Title</h3>
                                <% end_if %>

                                <% if $Content %>
                                <div class="card-slide-text">
                                    <p>$Content</p>
                                </div>
                                <% end_if %>

                                <% if $Button %>
                                    <% include Atwx/Sck/Includes/Button Link=$Button %>
                                <% end_if %>
                            </div>
                        </div>
                    <% end_loop %>
                </div>

                <% if $ShowArrows %>
                    <button class="swiper-button-prev">
                    </button>
                    <button class="swiper-button-next">
                    </button>
                <% end_if %>

                <% if $ShowDots && $Cards.Count > 1 %>
                    <div class="slider-dots">
                        <div class="swiper-pagination"></div>
                    </div>
                <% end_if %>
            </div>
        <% else %>
            <div class="swiper cards-slider"
                data-autoplay="false"
                data-show-dots="false"
                data-show-arrows="false">
                <div class="swiper-wrapper">
                    <div class="swiper-slide card-slide card-slide-placeholder">
                        <div class="card-slide-content">
                            <h3>Noch keine Karten</h3>
                            <p>Fügen Sie Karten über das Backend hinzu.</p>
                        </div>
                    </div>
                </div>
            </div>
        <% end_if %>
    </div>
</div>
