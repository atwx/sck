<header class="site_header">
    <% if $HeaderNavPosition == "above" %>
        <% if $SiteConfig.HeaderVariant == "Megamenu" %>
            <% include Atwx/Sck/Includes/NavMenus/Nav_MegaMenu Version=$NavStripVersion %>
        <% else_if $SiteConfig.HeaderVariant == "SimpleNavBar" %>
            <% include Atwx/Sck/Includes/NavMenus/Nav_SimpleNavBar Version=$NavStripVersion %>
        <% else_if $SiteConfig.HeaderVariant == "Sidebar" %>
            <% include Atwx/Sck/Includes/NavMenus/Nav_Sidebar Version=$NavStripVersion %>
        <% else %>
            <h1>$SiteConfig.Title</h1>
            <p>Kein Navigationsmenü ausgewählt. Bitte wähle ein Design in der SiteConfig aus.</p>
        <% end_if %>
    <% end_if %>

    <% if $ShowHeroSection && $HeroSlides.Count > 0 %>
    <div class="hero_section swiper" data-loop="true"
        data-slidesPerView="1"
        data-autoplay="$HeroAutoPlay"
        data-speed="$SwipeSpeed"
        <% if $HeroAutoPlayDelay && $HeroAutoPlayDelay > 0 %>data-autoplay-delay="$HeroAutoPlayDelay"<% end_if %>
        style="$HeroHeightStyle">
        <div class="swiper-wrapper">
            <% loop $HeroSlides %>
                <div class="swiper-slide">
                    <% if $DarknessOverlay > 0 %>
                        <div class="darkness" style="background-color: rgba(0, 0, 0, {$OpacityValue});"></div>
                    <% end_if %>
                    <div class="swiper-text">
                        <% if $HeroText %>
                            <div class="hero_text">$HeroText</div>
                        <% end_if %>
                    </div>
                    $Image.FocusFill(2000,1200)
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
        <% include Atwx/Sck/Includes/NavStrip Version=$NavStripVersion %>
    <% end_if %>
</header>
