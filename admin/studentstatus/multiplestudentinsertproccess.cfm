<cfinclude template="../../head.cfm">
<cfsetting requesttimeout="9999">
<cfif IsDefined("FORM.fuckyou") AND FORM.fuckyou EQ "form1">
<cftransaction>
  <cfloop from="1"  to="#FORM.NO#" index="i">
    <cfif #form['student_fname#i#']#  EQ "" AND #form['student_sname#i#']# EQ "">
    <cfelse>
  <cfquery datasource="#request.dsn#">
    INSERT INTO parent (parent_alias, parent_fullname, parent_phone, parent_address, user_id, parent_mothersphone)
	VALUES ('#form['parent_alias#i#']#', '#form['parent_alias#i#']# #form['student_sname#i#']#', '#form['parent_phone#i#']#','#form['parent_address#i#']#', 7, '#form['parent_mothersphone#i#']#')
  </cfquery>
  <cfquery datasource="#request.dsn#"  name="getparent">
   SELECT max(id) as parent
   FROM parent
  </cfquery>
  <cfquery datasource="#request.dsn#">
    INSERT INTO student (student_fname, student_mname, student_sname, student_sex, status_id, student_dob, file_no, studuent_address, parent_id, class_id, USER_ID)
VALUES ('#form['student_fname#i#']#', '', '#form['student_sname#i#']#', '#form['student_sex#i#']#', #form['status_id#i#']#, <cfqueryparam cfsqltype="cf_sql_date" value="#form['student_dob#i#']#">,#form['file_no#i#']#, '#form['parent_address#i#']#', #getparent.parent#, #form['class_id#i#']#
, 7)
  </cfquery>
<cfquery datasource="#request.dsn#" name="getstudent">
	SELECT MAX(student_id) as thestudent
    FROM student
	where student.user_id = 7
</cfquery>
<cfquery datasource="#request.dsn#">
	INSERT INTO schoolfeesPAYMENT ( student_id, schoolfeespayment_datetime, amount, term_id, paymentmode_id, user_id ) VALUES
    ( #getstudent.thestudent#, #now()#, 0, #url.term#, 1 , 7);
</cfquery>
 <cfquery datasource="#request.dsn#" name="GETCLASS">
	select *
    from schoolfees, class
	WHERE class.department_id = schoolfees.department_id
    AND class.CLASS_ID = #form['class_id#i#']#
    AND schoolfees.term_id = #url.term#
    AND schoolfees.user_id = 7
</cfquery>
<cfif #getclass.recordcount# eq 0 >
  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
  <tr>
    <th scope="col">    <p align="center" style="color:##990000">
	 The Selected Class does not have a Fixed School Fees </p></th>
  </tr>
</table>
<cfabort></cfif>
<cfquery datasource="#request.dsn#">
	INSERT INTO studentschoolfees ( student_id, studentschoolfees_dateadded, studentschoolfees_dateedited, studentschoolfees_amount,studentschoolfees_paid, term_id,  user_id ) VALUES
    ( #getstudent.thestudent#, #now()#, #now()#, #getclass.schoolfees_amount#,0, #url.term#, 7)
</cfquery>
</cfif>
</cFLOOP>
</cftransaction>
  <div class="col-md-2"></div>
<div class="callout callout-success col-md-8">
                <h4><i class="icon fa fa-check"></i>Your Request Was Saved Successfully!</h4>

                <p><a href="<cfoutput>#request.softwarepath#</cfoutput>">Return to previous tab.</a></p>
              </div>


</cfif>
<cfinclude template="../../footer.cfm">
