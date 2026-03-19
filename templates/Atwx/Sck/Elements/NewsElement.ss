<section class="section--NewsElement $BackgroundColor <% if $SiteConfig.ColorPrimaryFontWhite %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite %>secondary-white-text<% end_if %>">
    <div class="section_content animation--$FadeInAnimation $ElementDecoration">
        <div class="section_intro">
            <% if $ShowTitle %>
                <% if $UseH1ForTitle %>
                    <h1 class="hl1 section_title">$Title</h1>
                <% else %>
                    <h2 class="hl2 section_title">$Title</h2>
                <% end_if %>
            <% end_if %>
            <% if $Subtitle %>
                <h3 class="section_subtitle">$Subtitle</h3>
            <% end_if %>
            <% if $Description %>
                <div class="section_description">
                    $Description
                </div>
            <% end_if %>
        </div>

        <% if $NewsItems %>
            <div class="news_list">
                <% loop $NewsItems %>
                    <a href="$Link" class="btn link--button buttonvariant--readmore $Top.BackgroundColor">$Title</a>
                <% end_loop %>
            </div>
        <% end_if %>

        <% if $MainButton %>
            <div class="section_button">
                <% include Atwx/Sck/Includes/Button Link=$MainButton, BackgroundColor=$BackgroundColor %>
            </div>
        <% end_if %>
    </div>
</section>
