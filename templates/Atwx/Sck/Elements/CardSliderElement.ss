<section class="section--CardSliderElement $BackgroundColor $ElementDecoration <% if $SiteConfig.ColorPrimaryFontWhite %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite %>secondary-white-text<% end_if %>">
    <div class="section_content animation--$FadeInAnimation">
        <% if $ShowTitle %>
            <h2 class="hl2 section_title">$Title</h2>
        <% end_if %>
        <% if $IntroText %>
            <div class="section_intro_text">$IntroText</div>
        <% end_if %>
    </div>
    <% if $Cards %>
        <section class="embla" data-behaviour="embla">
            <div class="embla__viewport">
                <div class="embla__container">
                <% loop $Cards %>
                    <div class="embla__slide card-slide $BackgroundColor">
                        <% if $BackgroundImage %>
                            <% if $Button %>
                                <a href="$Button.URL" class="card-slide-image" <% if $Button.OpenInNew %>target="_blank"<% end_if %>>
                                    <img src="$BackgroundImage.FocusFill(400,300).URL" alt="$Title" loading="lazy">
                                    <div class="card-slide-overlay"></div>
                                </a>
                            <% else %>
                                <div class="card-slide-image">
                                    <img src="$BackgroundImage.FocusFill(400,300).URL" alt="$Title" loading="lazy">
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
            </div>

            <% if $ShowArrows %>
                <div class="embla__buttons">
                    <button class="embla-button__prev">
                    </button>
                    <button class="embla-button__next">
                    </button>
                </div>
            <% end_if %>

            <% if $ShowDots && $Cards.Count > 1 && $Loop %>
                <div class="slider-dots">
                    <div class="embla__dots"></div>
                </div>
            <% end_if %>

            <%-- <div class="embla__controls">
                <div class="embla__buttons">
                <button class="embla__button embla__button--prev" type="button">
                    <svg class="embla__button__svg" viewBox="0 0 532 532">
                    <path
                        fill="currentColor"
                        d="M355.66 11.354c13.793-13.805 36.208-13.805 50.001 0 13.785 13.804 13.785 36.238 0 50.034L201.22 266l204.442 204.61c13.785 13.805 13.785 36.239 0 50.044-13.793 13.796-36.208 13.796-50.002 0a5994246.277 5994246.277 0 0 0-229.332-229.454 35.065 35.065 0 0 1-10.326-25.126c0-9.2 3.393-18.26 10.326-25.2C172.192 194.973 332.731 34.31 355.66 11.354Z"
                    ></path>
                    </svg>
                </button>

                <button class="embla__button embla__button--next" type="button">
                    <svg class="embla__button__svg" viewBox="0 0 532 532">
                    <path
                        fill="currentColor"
                        d="M176.34 520.646c-13.793 13.805-36.208 13.805-50.001 0-13.785-13.804-13.785-36.238 0-50.034L330.78 266 126.34 61.391c-13.785-13.805-13.785-36.239 0-50.044 13.793-13.796 36.208-13.796 50.002 0 22.928 22.947 206.395 206.507 229.332 229.454a35.065 35.065 0 0 1 10.326 25.126c0 9.2-3.393 18.26-10.326 25.2-45.865 45.901-206.404 206.564-229.332 229.52Z"
                    ></path>
                    </svg>
                </button>
                </div>

                <div class="embla__dots"></div>
            </div> --%>
        </section>
        <%-- <div class="swiper cards-slider"
            data-behaviour="swiper"
            data-autoplay="$Autoplay"
            data-autoplay-delay="$AutoplaySpeed"
            data-loop="$Loop"
            data-effect="slide"
            data-pagination="$ShowDots"
            data-slidesperview="3"
            data-centeredslides="true"
            data-speed="$SwipeSpeed">

            <div class="swiper-wrapper">

            </div>

            <% if $ShowArrows %>
                <button class="swiper-button-prev">
                </button>
                <button class="swiper-button-next">
                </button>
            <% end_if %>

            <% if $ShowDots && $Cards.Count > 1 && $Loop %>
                <div class="slider-dots">
                    <div class="swiper-pagination"></div>
                </div>
            <% end_if %>
        </div> --%>
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
</section>
