<section class="section--ShowcaseElement $BackgroundColor">
    <div class="showcase">
        <% if $Image %>
            <div class="showcase__image">
                $Image.ScaleWidth(1920)
            </div>
        <% end_if %>

        <% if $DarknessOverlay > 0 %>
            <div class="showcase__darkness" style="background-color: rgba(0, 0, 0, {$OpacityValue});"></div>
        <% end_if %>

        <div class="showcase__content {$ContentPositionClass}">
            <div class="showcase__content-inner">
                <% if $ShowTitle && $Title %>
                    <h2 class="hl2 showcase__title">$Title</h2>
                <% end_if %>

                <% if $Content %>
                    <div class="showcase__text">
                        $Content
                    </div>
                <% end_if %>

                <% if $Button && $Button.exists() %>
                    <div class="showcase__button">
                        <% include Atwx/Sck/Includes/Button Link=$Button %>
                    </div>
                <% end_if %>
            </div>
        </div>
    </div>
</section>
