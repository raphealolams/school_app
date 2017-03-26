<cfinclude template="../../head.cfm">

<cfset CurrentPage=GetFileFromPath(GetBaseTemplatePath())>
<cfif IsDefined("FORM.MM_UpdateRecord") AND FORM.MM_UpdateRecord EQ "form1">
  <cfquery datasource="#request.dsn#">
    UPDATE schoolfees
		  set schoolfees_amount=<cfif IsDefined("FORM.schoolfees_amount") AND #FORM.schoolfees_amount# NEQ "">
		     <cfqueryparam value="#FORM.schoolfees_amount#" cfsqltype="cf_sql_numeric">
								<cfelse>
								   NULL
								</cfif>
WHERE schoolfees_id=<cfqueryparam value="#FORM.schoolfees_id#" cfsqltype="cf_sql_numeric">
  </cfquery><div class="col-md-2"></div>
<div class="callout callout-success col-md-8">
                <h4><i class="icon fa fa-check"></i>Your Request Was Saved Successfully!</h4>

                <p><a href="<cfoutput>#request.softwarepath#</cfoutput>">Return to previous tab.</a></p>
              </div>



</cfif>
<cfinclude template="../../footer.cfm">
