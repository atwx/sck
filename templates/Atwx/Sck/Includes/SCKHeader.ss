<header class="site_header">
    <% if $HeaderNavPosition == "above" %>
        <% if $NavStripVersion == "alternative" %>
            <% include Atwx/Sck/Includes/NavStripAlternative %>
        <% else %>
            <% include Atwx/Sck/Includes/NavStripDefault %>
        <% end_if %>
    <% end_if %>

    <% if $ShowHeroSection && $HeroSlides.Count > 0 %>
    <div class="hero_section swiper swiper--horizontal swiper--auto" <% if $HeroAutoPlay %>data-autoplay="true"<% end_if %> style="$HeroHeightStyle" <% if $HeroAutoPlayDelay && $HeroAutoPlayDelay > 0 %>data-autoplayDelay="$HeroAutoPlayDelay"<% end_if %>>
            <div class="hero_overlay"></div>
            <div class="swiper-wrapper">
                <% loop $HeroSlides %>
                    <div class="swiper-slide">
                        <div class="swiper-text">
                            <% if $HeroText %>
                                <div class="hero_text">$HeroText</div>
                            <% end_if %>
                        </div>
                        $Image.FocusFill(1000,400)
                    </div>
                <% end_loop %>
            </div>
            <% if $HeroAutoPlay %>
                <!-- If autoplay is enabled, show pause button -->
                <div class="swiper-button-pause">
                    <span class="icon-pause"></span>
                </div>
            <% end_if %>
        </div>
    <% end_if %>

    <% if $HeaderNavPosition == "below" %>
        <% if $NavStripVersion == "alternative" %>
            <% include Atwx/Sck/Includes/NavStripAlternative %>
        <% else %>
            <% include Atwx/Sck/Includes/NavStripDefault %>
        <% end_if %>
    <% end_if %>
</header>
