<section class="section--ShowcaseElement $BackgroundColor $ElementDecoration animation--$FadeInAnimation" <% if $Image %>style="background-image: url('$Image.FocusFill(1920,800).URL');"<% end_if %>>

    <% if $DarknessOverlay > 0 %>
        <div class="section_overlay" style="background-color: rgba(0, 0, 0, {$OpacityValue});"></div>
    <% end_if %>

    <div class="section_content boxposition--$ContentPosition">
        <div class="section_content_inner">
            <% if $ShowTitle && $Title %>
                <h2 class="hl2 section_title">$Title</h2>
            <% end_if %>

            <% if $Content %>
                <div class="section_text">
                    $Content
                </div>
            <% end_if %>

            <% if $Button && $Button.exists() %>
                <div class="section_button">
                    <% include Atwx/Sck/Includes/Button Link=$Button %>
                </div>
            <% end_if %>
        </div>
    </div>
</section>
