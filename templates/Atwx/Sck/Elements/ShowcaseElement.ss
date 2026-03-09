<section class="section--ShowcaseElement $BackgroundColor $ElementDecoration" <% if $Image %>style="background-image: url('$Image.FocusFill(1920,800).URL');"<% end_if %>>

    <% if $DarknessOverlay > 0 %>
        <div class="section_overlay" style="background-color: rgba(0, 0, 0, {$OpacityValue});"></div>
    <% end_if %>

    <div class="section_content boxposition--$ContentPosition">
        <div class="section_content_inner animation--$FadeInAnimation">
            <% if $ShowTitle && $Title %>
                <% if $UseH1ForTitle %>
                    <h1 class="hl1 section_title">$Title</h1>
                <% else %>
                    <h2 class="hl2 section_title">$Title</h2>
                <% end_if %>
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
