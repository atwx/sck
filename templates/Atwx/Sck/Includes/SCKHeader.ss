<header class="site_header">
    <% if $HeaderNavPosition == "above" %>
        <% if $NavStripVersion == "alternative" %>
            <% include Atwx/Sck/Includes/NavStripAlternative %>
        <% else %>
            <% include Atwx/Sck/Includes/NavStripDefault %>
        <% end_if %>
    <% end_if %>

    <% if $ShowHeroSection && $HeroSlides.Count > 0 %>
        <div class="hero_section swiper swiper--horizontal swiper--auto" style="$HeroHeightStyle">
            <div class="hero_overlay"></div>
            <div class="swiper-wrapper">
                <% loop $HeroSlides %>
                    <div class="swiper-slide">
                        <div class="swiper-text">
                            <% if $Title %>
                                <div class="hero_topline">$Title</div>
                            <% end_if %>
                            <% if $SubTitle %>
                                <div class="hero_second_topline">$SubTitle</div>
                            <% end_if %>
                        </div>
                        $Image.FocusFill(1000,400)
                    </div>
                <% end_loop %>
            </div>
            <div class="swiper-pagination"></div>
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
