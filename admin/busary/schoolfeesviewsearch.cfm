<cfinclude template="../../head.cfm">

<cfquery datasource="#REQUEST.DSN#" name="GETSESSION"> 
	  	SELECT *
        from term, session
		where term.session_id = session.SESSION_id
        order by term_ID
</cfquery>

    <cfform>
    <div class="box">
      <div class="box-header">
        <h1 class="text-info"><b><cfoutput> Search Session </cfoutput></b></h1>
      </div>
<div class="box-body">
<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info"> 	 
<div class="col-md-6">
  <tr>

        <td align="center">Session</td>

    <td align="center"><select  name="dterm"> <cfoutput query="GETSESSION"> <option value="#getsession.term_id#">(#getsession.session_name#) #getsession.term_name#</option></cfoutput></select>
 </td>

  </tr>
  </div>
</table> 
</div>
</div>
</cfform>

 

<cfdiv bind="url:schoolfeesview.cfm?schoolfeeviewTERM={dterm}" /><div></div>
<cfinclude template="../../footer.cfm">
