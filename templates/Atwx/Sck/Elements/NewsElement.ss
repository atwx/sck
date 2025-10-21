<div class="section section--NewsElement $BackgroundColor">
    <div class="section_content">
        <div class="section_intro">
            <% if $Title %>
                <h2 class="section_title">$Title</h2>
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
                    <div class="news_item">
                        <div class="news_item_content">
                            <% if $Title %>
                                <h4 class="news_item_title">
                                    <% if $Link %>
                                        <a href="$Link.LinkURL"<% if $Link.OpenInNew %> target="_blank"<% end_if %>>
                                            $Title
                                        </a>
                                    <% else %>
                                        $Title
                                    <% end_if %>
                                </h4>
                            <% end_if %>
                            <% if $Content %>
                                <div class="news_item_description">
                                    $Content
                                </div>
                            <% end_if %>
                        </div>
                    </div>
                <% end_loop %>
            </div>
        <% end_if %>

        <% if $MainButton %>
            <div class="section_button">
                <% include Atwx/Sck/Includes/Button Link=$MainButton, BackgroundColor=$BackgroundColor %>
            </div>
        <% end_if %>
    </div>
</div>
