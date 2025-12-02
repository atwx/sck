<section class="section section--EventsOverview $BackgroundColor <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <h1 class="hl1 text_title">$Title</h1>
        <div class="text_intro">$Intro</div>
        <% loop $Events %>
            <a href="$Link" class="events_item" aria-label="Mehr erfahren zu $Title">
                <div class="events_content">
                    <div class="events_date">$RenderDateRange</div>
                    <h2 class="events_title">$Title</h2>
                    <div class="events_shortcontent">$ShortContent</div>
                </div>
            </a>
        <% end_loop %>
        <% if $Events.MoreThanOnePage %>
            <div class="section_events_pagination">
                <% if $Events.NotFirstPage %>
                    <a class="prev-link" href="$Events.PrevLink">«</a>
                <% end_if %>
                <% loop $Events.PaginationSummary %>
                    <% if $CurrentBool %>
                        <a class="page-link current">$PageNum</a>
                    <% else %>
                        <% if $Link %>
                            <a class="page-link" href="$Link">$PageNum</a>
                        <% else %>
                            ...
                        <% end_if %>
                    <% end_if %>
                <% end_loop %>
                <% if $Events.NotLastPage %>
                    <a class="next-link" href="$Events.NextLink">»</a>
                <% end_if %>
            </div>
        <% end_if %>
        <% if $ShowPastEvents %>
            <a href="$Top.Link()" class="btn link--button">Aktuelle Termine</a>
        <% end_if %>
    </div>
</section>
$ElementalArea
