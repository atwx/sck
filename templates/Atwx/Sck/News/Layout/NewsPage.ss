<section class="section section--NewsOverview $BackgroundColor <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <h1 class="hl1 text_title">$Title</h1>
        <div class="text_intro">$Intro</div>
        <% loop $getNews %>
            <a href="$Top.Link/view/$ID" class="news_link_overlay" aria-label="Mehr erfahren zu $Title">
                <div class="news_item">
                    <div class="news_image <% if not $Image %>no-image<% end_if %>">
                        $Image
                    </div>
                    <div class="news_content">
                        <h2 class="news_title">$Title</h2>
                        <div class="news_date">$Date.Nice</div>
                        <div class="news_shortcontent">$ShortContent</div>
                        <p class="btn link--button"><%t More "Mehr darüber" %></p>
                    </div>
                </div>
            </a>
        <% end_loop %>
        <% if $News.MoreThanOnePage %>
            <div class="section_news_pagination">
                <% if $News.NotFirstPage %>
                    <a class="prev-link" href="$News.PrevLink">«</a>
                <% end_if %>          
                <% loop $News.PaginationSummary %>
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
                <% if $News.NotLastPage %>
                    <a class="next-link" href="$News.NextLink">»</a>
                <% end_if %>
            </div>
        <% end_if %>
    </div>
</section>
$ElementalArea
