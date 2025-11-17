<div class="section section--HeroElement">
    <div class="hero_content">
        <% if $Image %>
            <div class="hero_image">
                $Image.ScaleWidth(1920)
            </div>
        <% end_if %>
        <style>
            :root {
                --HeroDarkness: rgba(0, 0, 0, {$OpacityValue});
            }
        </style>
        <div class="darkness"></div>

        <div class="hero_text_wrapper">
            <div class="hero_text">
                <% if $ShowTitle %>
                    <h1>$Title</h1>
                <% end_if %>
                <div class="hero_text_content">
                    $Content
                </div>
                <% if $Button %>
                    <% include Atwx/Sck/Includes/Button Link=$Button %>
                <% end_if %>
            </div>
        </div>
    </div>
</div>
