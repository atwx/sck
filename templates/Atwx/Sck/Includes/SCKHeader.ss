<header class="site_header">
    <% if $HeaderNavPosition == "above" %>
        <% if $NavStripVersion == "alternative" %>
            <% include Atwx/Sck/Includes/NavStripAlternative %>
        <% else %>
            <% include Atwx/Sck/Includes/NavStripDefault %>
        <% end_if %>
    <% end_if %>

    <% if $ShowHeroSection && $HeroImage %>
    <div class="hero_section" style="background-image: url('$HeroImage.AbsoluteURL'); $HeroHeightStyle">
        <div class="hero_overlay"></div>
        <div class="hero_content">
            <div class="hero_text_content">
                <% if $HeroTitle %>
                <div class="hero_title">$HeroTitle</div>
                <% end_if %>
                <% if $HeroSubtitle %>
                <div class="hero_subtitle">$HeroSubtitle</div>
                <% end_if %>
            </div>
        </div>
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
