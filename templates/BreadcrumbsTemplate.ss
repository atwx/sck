<% if $Pages && URLSegment != "home" %>
    <section class="section--Breadcrumbs">
        <div class="section_content">
            <a href="" class="breadcrumb-0">Startseite</a> &raquo; 
            <% loop $Pages %>
                <% if $IsLast %>
                    <div class="breadcrumb-current">$MenuTitle.XML</div>
                <% else %>
                    <% if not Up.Unlinked %>
                        <a href="$Link" class="breadcrumb-$Pos">
                    <% end_if %>
                    $MenuTitle.XML
                    <% if not Up.Unlinked %>
                        </a>
                    <% end_if %> 
                    &raquo;
                <% end_if %>
            <% end_loop %>
        </div>
    </section>
<% end_if %>
