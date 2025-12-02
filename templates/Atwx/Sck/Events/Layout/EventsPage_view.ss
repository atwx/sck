<% with $Event %>
    <div class="section section--Event">
        <div class="section_content">
            <div class="section_backlink">
                <a href="javascript:history.back()" class="backlink_link" aria-label="Zurück zur Übersicht"><%t Back "« Zurück" %></a>
            </div>
            <div class="event_content">
                <div class="event_text">
                    <h2 class="event_title">$Title</h2>
                    <div class="event_datekat">$RenderDateRange</div>
                    <p class="event_content">$Content</p>
                    <% loop $Links %>
                        <div class="event_link">
                            <% include Atwx/Sck/Includes/Button Link=$Me %>
                        </div>
                    <% end_loop %>
                    <div class="event_peoples">
                        <% loop $People %>
                            <div class="event_person">
                                <% if $Image %>
                                    <img class="event_person_image" src="$Image.FocusFill(300,300).Url" alt="$Image.AltText">
                                <% end_if %>
                                <h3 class="event_person_name">$Title</h3>
                                <% if $Function %><div class="event_person_role">$Function</div><% end_if %>
                                <% if $Phone %><a href="tel:$Phone" class="event_person_phone">$Phone</a><% end_if %>
                                <% if $Email %><a href="mailto:$Email" class="event_person_email">$Email</a><% end_if %>
                                <% if $Address %><div class="event_person_address">$Address</div><% end_if %>
                            </div>
                        <% end_loop %>
                    </div>
                </div>
            </div>
        </div>
    </div>
<% end_with %>
