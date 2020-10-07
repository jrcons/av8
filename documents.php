<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?php echo CALLSIGN?> Documentation</title>
  <link rel="stylesheet" href="av8_style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">

    /* plus glyph for showing collapsible panels */
    .panel-heading .accordion-plus-toggle:before {
      font-family: FontAwesome;
      content: "\f068";
      float: right;
      color: silver;
    }

    .panel-heading .accordion-plus-toggle.collapsed:before {
      content: "\f067";
      color: silver;
    }

    /* arrow glyph for showing collapsible panels */
    .panel-heading .accordion-arrow-toggle:before {
      font-family: FontAwesome;
      content: "\f078";
      float: right;
      color: silver;
    }

    .panel-heading .accordion-arrow-toggle.collapsed:before {
      content: "\f054";
      color: silver;
    }

    /* sets the link to the width of the entire panel title */
    .panel-title>a {
      display: block;
    }

    .header-av8 {
      font-family: Impact, Charcoal, sans-serif;
      font-size: 30px;
      text-align: center;
    }

    .page-header-av8 {
      margin: 10px 0 10px;
      border-bottom: 1px solid #eee;
    }
  </style>
</head>

<body>
  <div class="page-header-av8">
    <a href="welcome.php" class="btn btn-warning">Back</a>
    <a href="logout.php" class="btn btn-danger">Sign Out</a></h4>
  </div>
  <p class="btn btn-primary btn-block" style="text-align:left; padding-left:6px;">
    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z" />
      <path fill-rule="evenodd"
        d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z" />
    </svg>
    <?php echo CALLSIGN?> Group Rules and Other Documentation
  </p>
  <br>
  <div class="panel-group" id="accordion7401210" role="tablist" aria-multiselectable="false">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading8122873">
        <h5 class="panel-title">
          <a role="button" data-toggle="collapse" class="accordion-plus-toggle collapsed" data-parent="#accordion7401210" href="#collapse8122873" aria-expanded="false" aria-controls="collapse8122873">GROUP/CLUB OWNERSHIP Terms & Conditions</a>
        </h5>
      </div>
      <div id="collapse8122873" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8122873">
        <div>
          <h3 align="center">GROUP/CLUB OWNERSHIP Terms & Conditions for</h3>
          <h4>Evektor EV97 TeamEurostar G-SHMI</h4>
          <h4>V7, 4th July 2020</h4>
          <br>
          <h4><a href="./assets/documents/SHMIrules.pdf" download="SHMIrules.pdf">Download a copy (PDF) to your local tablet/PC</a></h4>
          <br>
          <p>The purpose of this document is to inform and safeguard the Owner/Lessor (hereafter called
            “the Owner”) and Hirers of Evektor EV97 TeamEurostar G-SHMI, C/N 3013 (hereafter called
            “The Aircraft”).
          <p>The Aircraft is owned as a Group Aircraft and all Hirers are deemed as capital share members
            of the Group, with mutual responsibility for The Aircraft as laid out in the Group Constitution
            and Operation (Addendum to this document).
          <p>Therefore, a Hirer for the purposes of this agreement is defined as a Group member owning
            a capital share who pays the Group to fly the aircraft.
            Hirers must establish Group Membership by way of a Capital Share ownership of the Group
            and its assets which must be established and confirmed before commencement of hire of The
            Aircraft. Capital Share Owners are collectively known as “The Owner” in this document and
            as a default, The Trustee of The Group shall be designated as the spokesperson of all the
            Owners as capital shareholders.
          <p>Certain legal and financial responsibilities are laid out in this document which imply potential
            forfeiture of part or all of the Capital Share, and Hirers are to familiarise with these obligations
            before agreement and signing of this document.
            Group membership implies certain rights and influences on the administration and operation
            of The Aircraft. These are also laid out in this document, along with identified caveats which
            safeguard the security and longevity of the ownership, hangarage and operation of The
            Aircraft.
          <p>It is an overarching principle of the operation of The Aircraft that this shall be a non-profit
            operation, and that all financial policy laid out in this document shall be for the purpose of
            supplying The Aircraft to Hirers for enjoyable recreational aviation activities at an agreed,
            minimised cost, in compliance with rules and conditions laid down by the Civil Aviation
            Authority and the British Microlight Aircraft Association.
          <p>Hirers must comply with all relevant conditions imposed herein.
            <br>
          <h4>Designatory Information</h4>
          <p>
          <ol>
            <li>The Owner is The G-SHMI Flying Group, c/o The Trustee(s).
            <li>A Trustee is appointed by the current group members as required. A member of the
              group will nominate another member of the group to the role where a simple majority
              email vote will endorse the appointment. In the event of a dispute, the current Trustee(s)
              have the casting vote.
            <li>The Hirer is any group member. Any agreed changes and variances to this agreement
              that may arise at any time will be agreed between the Owner and Hirer and will be noted
              and signed in an addendum to this agreement.
              <br>
              <h4>Conformance & Legislation</h4>
            <li>Flying operations shall be conducted in accordance with European Aviation Safety
              Authorities (EASA) and/or Civil Aviation Authority (CAA) and/or British Microlight Aircraft
              Association regulations & the Permit to Fly (along with any exemptions) together with the
              terms of the insurance policy, any local regulations or additional regulations advised in
              writing to the Hirer by the Owner/Owner’s Agent.
            <li>The Hirer also warrants that the aircraft will only be used for the legal purposes declared
              at the time of hiring, which must be non-commercial, recreational and/or pleasure flying.
            <li>Hirers shall be responsible at all times to be aware of any EASA/CAA/BMAA, international,
              national or local regulations affecting the safe and legal operation of the aircraft.
            <li>The Hirer will implicitly warrant & confirm that the pilot & all his passengers will not use or
              associate the aircraft with any illegal activities.
            <li>The Hirer shall not sell, mortgage, charge, pledge, part with possession or otherwise deal
              with the aircraft & any of its ancillary equipment and documentation, and shall protect same
              against distress, execution, seizure & shall indemnify the Owner against all losses,
              damage, costs, charges & expenses as a direct result of any failure to observe & perform
              this condition except in the event of Government requisition.
            <li>Hirers shall not hire the aircraft out to other parties.
              Maintenance & Costs
            <li>The aircraft’s maintenance shall be to BMAA Permit to Fly requirements. The maintenance
              and repair work shall be carried out by competent persons nominated by the trustee at the
              home base. Inspection shall be by a BMAA certified inspector nominated by the group
              trustee. Owner will pay proportionally for the aircraft’s operational maintenance, and
              hangarage and/or parking at its’ home base only.
            <li> The Trustee reserves the right to review all hire charges as & when operational costs
              dictate. The Trustee will give written notice of any cost revisions to individual Hirers.
              Charges for the hire of the aircraft shall then be agreed in writing by the Trustee / Hirer in
              a signed addendum to this agreement.
            <li> All hires shall be based on “Brakes Off to Brakes On” time, which is defined as being Takeoff
              Time to Landing Time plus 5 minutes taxy time on each side of Take-off and Landing.
              Compensating errors are acceptable but the cost of any inaccuracy will be borne by the
              Hirer.
            <li> The cost of all hires is due in full with no deductions, as agreed in the financial agreement
              with the Hirer (addendum to this agreement). Should payment not be cleared within 30
              days of invoice issue, the Owner reserves the right to charge interest at 4% above the
              published Barclay’s Bank base rate compounded on each 1/4 day & paid both before &
              after judgement or arbitration award.
            <li> Obligations to pay hire charges will be specifically referred to either as exclusive of VAT
              (Value Added Tax) or inclusive of VAT. At its inception, The Group is set up as a non-VAT,
              private group.
              <h4>Accidents, Damage and Liability</h4>
            <li> In the event of any damage or injury being sustained to the aircraft or to third parties by
              the Hirer, or whilst under his or her control, the following shall apply:
              <ul>
                <li>a. If any damage is caused through violation of this agreement and any addendums
                  attached, or through the Hirer’s own carelessness, negligence or pilot error, the Hirer
                  at fault shall be responsible for the uninsured portion of the damage to the aircraft as
                  described on the insurance certificate and/or in the Aircraft Tech Log & any
                  consequential costs. As covered by the current insurance policy, this amount is equal
                  to the stated excess for any claim arising.
                <li>b. In the case of doubt as to the cause of an accident, the Owner & Hirer shall abide by
                  the findings of the CAA, BMAA and/or the AAIB and/or loss adjusters.
                <li>c. Any Hirer finding it necessary in an emergency to purchase parts or to have repair
                  work carried out on the aircraft, not in excess of £200 plus local tax, may do so in their
                  own name. However, every reasonable attempt to contact the Owner should be made
                  in the first instance. On presentation of a properly receipted invoice, the said amount
                  will be refunded.
              </ul>
              <h4>Hirer benefits</h4>
            <li> On overseas flights Hirers may have the benefit of fuel duty drawback if any is available.
              Qualifications & Scope of Use
            <li> It is the responsibility of all Hirers to ensure that they are in possession of a valid medical
              certificate & appropriate pilots licence at all times with ratings and currency appropriate to
              the aircraft and scope of flying being undertaken.
            <li> All Hirers agree to inform the Trustee or nominated person/company ( Elevation Airsports
              Ltd ) of the CAA Medical expiry date and Certificate of Competency/Experience expiry
              date & must supply a photocopy of all appropriate licences, including Pilot’s Licence,
              Certificate of Experience, & Medical Certificate to the Owner at each renewal on request.
              The Trustee or Elevation Airsports Ltd undertakes to securely maintain a record/copy of
              such dates of validity and licence qualifications and to check currency with the hirer on or
              around renewal dates of medicals and certificates of competence.
            <li> All P1 Hirer’s shall have the appropriate licence, for example, a PPL(A) or NPPL
              (Microlights) with P1 currency. For G-SHMI, the P1 Hirer shall be cleared/checked on 3-
              axis microlight aircraft in general and the ev97 Eurostar in particular. Any Hirer must have
              flown a Microlight landplane aircraft within the times below:
              <ul>
                <li> Any pilot with less than 200 hours P1 time - 30 days
                <li> Any pilot with less than 50 hours P1 on the Eurostar - 30 days.
                <li> Pilots between 200 and 400 hours P1 time, and with more than 50 hours P1 on the Eurostar - 40 days
                <li> Pilots over 400 hours P1, and with more than 50 hours P1 on the Eurostar - 60 days.
                <li> Pilots over 1000 hours P1 and with more than 25 hours P1 on the Eurostar – 60 days
              </ul>
              <br>
            <li> Hirers who are not checked out on type may hire G-SHMI for the purpose of checking out
              on type, providing they undertake such checkout flights with a qualified, current instructor
              who is authorised by The Hirer to carry out such checkouts. In such cases, the instructor
              must provide the hirer with evidence of such qualification and currency prior to the first
              flight with the hirer.
            <li> The Hirer undertakes to restrict use of the aircraft to PPL recreational use and/or training
              flights if checkout on type is required. The aircraft shall not be used for the purposes of
              passenger or air experience flights in competition with Elevation Airsports Ltd.
            <li> Any other usage that Hirers propose to undertake must be requested to the Owner in
              writing or by email at least 24 hours in advance. Extensions to the scope & nature of work
              allowed may be granted by the Owner to the Hirer in writing as an addendum to this
              agreement. Any extra insurance charges must be paid by the Hirer.
            <li> The owner will allow rental by the Hirer on a basis of a minimum rental hours requirement
              as stipulated in the addendum to this agreement.
            <li> Hirers proposing to use airfields not listed in current Pooley/ Bottlang/Jeppesen guides
              must satisfy themselves that the airfield / airstrip is safe to use prior to departure. Evidence
              may be required of the nature of such landing sites, prior permission and/or notification
              by/to landowners, police, Special Branch, HM Customs and/or foreign authority bodies as
              relevant to the intended flight(s).
            <li> No air races or competitions of any kind may be entered without (a) The Owner’s
              permission and (b) prior written approval from the Insurers of the Aircraft. Any extra costs
              incurred in this case are the responsibility of the Hirer(s) involved.
            <li> Advance Bookings by ALL users must be logged with the Owner’s administration
              procedure/service via Website: https://www.shlott.com/calendar.
              Responsibilities
            <li> The Hirer shall be responsible for ALL aspects of the aircraft from the time of moving the
              aircraft from its’ home base of Gloucestershire Airport (hereafter known as Home Base)
              hangar/parking spot until the engine stops & the aircraft is parked & secured back at the
              home base hangar/parking spot unless specified otherwise in this agreement.
            <li> Hirers shall be responsible for notifying The Owner immediately of any change to their
              notified schedule as soon as the decision is made, by telephone or fax or read-receipted
              e-mail, & the Hirer shall take every reasonable precaution to ensure that the aircraft does
              not return to base later than anticipated, so as not to adversely affect future hires.
            <li> Hirers bear all costs associated with returning the aircraft to Home Base if
              delays/grounding occur due to adverse weather conditions, impoundment, grounding,
              legislation infringements or any other scenario which the Hirer may reasonably have
              foreseen or is responsible for under the terms of this agreement.
            <li> Away from Home Base, Hirers must use their own funds as required. The Owner’s policy
              on reimbursement of fuel rates applies to all Hirers.
            <li> All costs associated with a movement (including but not limited to landing fees,
              navigational fees, overnight parking or hangarage charges, handling charges, fines or
              levies), are the responsibility of the Hirer. Therefore, if a Hirer defaults on payment of a
              cost incurred (e.g. landing fee), the Owner will invoice the Hirer for the default amount to
              recover such costs from the Hirer, or may deduct the amount from the Hirer’s Capital Share
              where applicable.
            <li> It is all Hirers’ responsibility for ensuring the aircraft is always left properly secured, tied
              down or hangared if possible when away from base. Flight controls must be locked using
              seat harnesses or control locks and chocks/tie-downs must be used.
            <li> Any portable equipment must be removed if the aircraft is left unattended, and the Hirer
              assumes personal responsibility for this item whilst the aircraft is on hire. Portable
              equipment will be kept in a secure locker or by the Owner at Home Base and on the
              completion of a hire, portable equipment is to be replaced back in the secure locker at
              Home Base or collected/stored by the Owner in the secure hangar.
            <li> The Hirer must take into account local weather conditions & security arrangements in
              assessing the secured status of the aircraft in such situations, bearing in mind uninsured
              liabilities for damage which will be payable from the Hirer if found to blame.
            <li> All flight times are to be accurately recorded in the tech log throughout the duration of the
              flight & on termination. Any defects should also be accurately recorded.
            <li> Any defects affecting the airworthiness of the aircraft are to be advised to the Owner by
              telephone, text or email immediately on return to base.
            <li> After landing/shutdown during a flying day, the aircraft shall be parked & properly tied
              down, locked & left clean, neat & tidy with seat belts fastened & control column fixed in
              position, taking account of prevailing weather conditions, e.g. wind speed/direction.
            <li> At the end of a flying day, the Hirer takes responsibility, in the absence of the Owner, for
              ensuring overnight parking at Home Base is safely & securely completed. A Hirer shall
              take responsibility for the same if parking the aircraft overnight at a location other than
              Home Base. This means confirming that the aircraft is locked & secured, with control locks
              in place, all covers securely strapped on, & securely tied down for overnight parking in the
              open (taking into account forecast weather conditions, e.g. prevalent wind speeds &
              direction) and portable equipment secured.
            <li> The Owner is not responsible for battery recharges at any location if a Hirer has left
              electrical systems switched on after shutdown. The Hirer must pay charges arising.
              Insurance
            <li> The aircraft insurance policy is in the name of The Trustee(s) of the G-SHMI Group.
              Details of the cover are kept in the tech log in the CFIs office. The Owner will review the
              insurance policy at regular periods & will supply a copy to the Hirer for reference on
              request.
            <li> Any removable items of the aircraft equipment not specifically covered by aircraft
              insurance are considered as contents or personal effects & are the complete responsibility
              of the Hirer for loss or damage at full market replacement value & should be insured by
              the Hirer as such.
            <li> Whenever items are left in the aircraft, the aircraft must be left secure & items hidden as
              appropriate. These may include, but are not limited to: Aircraft Pilots Operating Handbook,
              avionics handbooks, control lock(s), tiedowns, pitot cover, Fire Extinguisher, First Aid Kit,
              Fuel Checker, Tech Log.
              <h4>Disputes, Breaches, Complaints, Notice</h4>
            <li> If at any time any dispute or question shall arise between the Owner & any Hirer in regard
              to the hire of the aircraft & such dispute cannot be amicably resolved between the parties
              then such dispute, difference or question shall be referred pursuant to the Arbitration Act
              1950 or any statutory modification thereof.
            <li> All regulations in this agreement shall be complied with at all times. All complaints &
              suggestions shall be notified to the Owner as soon as possible, initially by telephone or
              verbal discussion and, if necessary, in writing.
            <li> Any breach of the Owner’s regulations and/or EASA/CAA/BMAA regulations, from time to
              time in force, shall constitute grounds for immediate withdrawal of the right to hire or fly
              the aircraft until such time as the Owner decides to withdraw the grounding.
            <li> Any financial penalties incurred by the Hirer as a result of his/her responsibilities and
              agreements with The Owner, as laid out in this document, shall either be paid to the Owner
              or shall be deducted from the Capital Share originally paid by the Hirer when agreeing to
              these terms and conditions.
              <p>Known financial penalties include:
              <ul>
                <li> An excess (as defined in the current insurance policy) in respect of any insurance claim
                  made as a result of an accident or damage to the aircraft or any third party.
                <li> The list price of any lost, damaged, stolen or destroyed portable equipment (or
                  equivalent should this stop production) whilst the aircraft is being hired from the Owner.
                <li> Interest charged in the event of late payments by The Hirer to The Owner.
              </ul>
            <li>Any reasonable administration fees caused by incurring penalties, extra costs or extra
              administration above the regular administration needed to hire/lease the aircraft shall be
              added to such financial penalties as covered within this document.
          </ol>
          <h4>ADDENDUM to LEASE/HIRE AGREEMENT - G-SHMI</h4>
          <strong>Commencement Date:</strong>
          It is agreed that the aircraft G-SHMI will be hired from The Owner subject to the terms and
          conditions laid out in the Lease/Hire Agreement, from the above date onwards at the following
          rate :
          <ul>
            <li>£ 50 AMOUNT PER FLYING HOUR (WET RATE INCL.OF VAT)
            <li>£ 50 Standing Order payable Monthly on 1st of every calendar month (For Hangarage, Insurance, Annual Charges & Annual Administration)
          </ul>
          <p><em>Wet rate</em> = Rental rate inclusive of any fuel and oil inputs necessary to fly the aircraft.
            <br>
          <p>Hirer Rental hours minimums are as follows:
            <br>
          <p>PERIOD MINIMUM HOURS RENTAL REQUIRED: To be agreed (No Minimums)
          <p>Payment Agreement – Monthly, after end of each month.
          <p>A summary of flying hours accumulated during the month will be collected by the Trustee or
            representative. The Trustee or representative will inform all group members of time totals and
            charges due at the wet rate. Hirers must then forward fees payable, less fuel costs
            (accompanied by any fuel invoices) to the Trustee. Payment by cheque or Electronic Transfer
            will be made payable to the bank account designated by the Trustee.
          <h4>ADDENDUM – G-SHMI GROUP CONSTITUTION & OPERATION</h4>
          <p><strong>GENERAL</strong>
          <ol>
            <li> Any operations for renewal of aircraft Permit to Fly will only be undertaken by the
              person authorised by EASA/CAA/BMAA to undertake such tests;
            <li> Pilots undergoing instruction or checkout by an instructor must be authorised by the
              Group nominated Instructor for each flight on the authorisation sheet provided;
            <li> It is the responsibility of members intending to fly as Pilot-In-Command of the Group
              aircraft to ensure that the aircraft is serviceable and all pre-flight actions required of a
              Pilot are completed and the tech log filled in;
            <li> The aircraft will be left in a clean and tidy state for the next member's use;
            <li> It is the responsibility of the pilot in command to ensure that all national and airport
              rules in force at that time, appertaining to the control of Covid19 or any such infectious
              disease, are complied with during all phases of the flight.
            <li> All members should know and understand the aircraft systems, regular checklists and
              emergency checklist actions required;
            <li> All flights must be booked in and out in the Aircraft Tech Log book, along with fuel/oil
              uplifts and defects and comments;
            <li> The pilot of the first flight of the day should total the flying hours and update the tech
              log from the previous days flying.
            <li> Any adverse comment or defect will be dealt with in consultation with the trustee and
              Elevation Airsports CFI / MD.
          </ol>
          <h4>THE RULES OF THE FLYING GROUP</h4>
          <ol>
            <li> The Name of The Group: The full name of the "Group" is The G-SHMI Flying Group
            <li>Object: The object of the Group is to provide safe and economical flying for the members of the Group
              through the operation and ownership of an aeroplane or aeroplanes with BMAA issued Permit
              to Fly certificates.
              <p>The maximum number of members of all categories is limited to 20 but will in practice be sized
                to provide a balance of utilisation and availability to all group members.
              <p>The Group will be run on a non-profit making basis. Charges and fees will be reviewed against
                this objective and periodic adjustments made to maintain this objective.
            <li>Administration: The Group shall be administered by the trustee, who must be a member of the group and
              owner of a capital share in the Group.
            <li>Group Communications: The majority of inter-group discussions and communication will be via watsapp or email.
              Group meetings will be held as required.
            <li>Membership: A person of not less than 17 years of age may become a member of the Group in
              accordance with paragraph 17(d) by applying to the trustee, agreeing to the Group policy
              and rules and by paying the agreed purchase price for share ownership to the departing
              member of the Group.
            <li>Membership - Capital Share: The standard group membership will be by way of a Capital Share whose suggested
              purchase price is determined by the trustee(s) based on the current market value of the
              aircraft.
              <p>The actual purchase price is at the discretion of the shareholder
              <p>The residual of unallocated shares lies with the Trustee(s).
              <p>The Group members agree to absorb any maintenance or standing costs not absorbed by the
                group engine/airframe fund or by insurance claims.
            <li>Group Membership Voting Rights: Capital share owners will have voting rights in proportion to their capital share of the aircraft,
              expressed as one vote per percentage of capital share owned.
              <p>The Trustee will have an additional (casting vote) at capital share group meetings.
            <li>Members Rights to use Group Aircraft: All Members shall have equal rights to use the aeroplane(s) owned or operated by the Group
              subject to the operational regulations and group rules currently in force.
              <p>Use of the Group’s aircraft will be by way of a booking system, which shall be internet-based
                and accessible to all Group members of all categories.
            <li>Capital Share Members’ Obligations: The Capital Share Owners shall have obligations towards fixed costs including aircraft
              insurance, hangarage and maintenance in proportion to their capital share in the aircraft
              owned and operated by the Group.
              <p>These costs shall be reflected in the monthly and hourly flying charges levied on the group, in accordance with the stated Group objectives of being
                non-profit making.
              <p>Capital Share Owners have a financial obligation in terms of liabilities which is in proportion to
                their financial holding in the Group’s aircraft. This may need to be brought into play in the
                event of the death or withdrawal from the group of the current Trustee.
            <li>Persons permitted to fly: Only Group members may act as Pilot-In-Command.
              A member may carry a passenger at his discretion and may also permit the passenger to pilot
              the aeroplane although the member must at all times remain Pilot-In-Command.
              <p>Group Members must be current flying members of Elevation Airsports Ltd in order to fly the
                aircraft from its home base of Gloucestershire Airport. ( provision currently suspended )
            <li>Value of a Capital Share: In the event of a member being expelled or becoming deceased, the Capital Share Owners
              agree to refund the Capital Share Value less annual depreciation, an administration charge
              and any outstanding penalty charges as defined and agreed to in the lease/hire agreement
              and signed agreement below.
              <p>In the event of the death of the Trustee, the Group Members shall convene a meeting to
                decide how the residual of share value held by the Trustee shall be refunded to the Trustee’s
                estate. This shall be a legal obligation and may be realised either by: sale of an aircraft, sale
                of shares to new group members or share buy-out by the remaining group members.
            <li>Sale of a Capital Share: Any member wishing to sell a Capital share can offer his share for sale to potential new
              members who are able to satisfy the various criteria and obligations set out in the preceding
              paragraphs.
              <p>The seller has no claim on any portion or share of the bank funds retained for the purposes
                of maintenance, etc of the aircraft.
              <p>The Trustee(s) retain the right to reject any potential member, but shall not act unreasonably
                in considering proposed members.
              <p>The purchaser shall pay the agreed purchase price of a Capital Share and forward proof of
                purchase price to the Trustee as required.
              <p>The Trustee shall arrange for the change of ownership to be validated on the Share Certificate
                and for the transfer of the Share Certificate to the new member.
            <li>Share Certificate: Each member is to receive a Share Certificate indicating category and proportion of Group
              assets owned by him / her.
              <p>A sample Share Certificate is to be kept by the Trustee(s) together with signed copies of the
                Rules of the Group.
            <li>Expulsion and Suspension: The Trustee(s) may summarily suspend a member's right to act as Pilot-In-Command, copilot
              or passenger, if it considers that the member's conduct has been, or is likely to be,
              detrimental to the interests of the Group or contrary to the group rules; the reasons to be
              given in writing to all members within one week. Consultation with Instructional staff at
              Elevation Airsports Ltd may be undertaken as part of this procedure.
              <p>The member suspended will be notified of the suspension within 48 hours by email by the
                Trustee(s).
              <p>A member so suspended shall have the right of appeal to a panel of three selected group
                members which will include at least one trustee.
              <p>An appeal will be decided by a vote of the panel consisting of three members and a trustee.
                The trustee will have the casting vote if no decision is reached by the members. If a suspension
                is for a limited period the member shall continue to pay the monthly subscription. In the event
                that a member is expelled from the Group a Trustee shall write to the member confirming the
                price at which the Group will pay the expelled member’s Capital Share, subject to the
                deduction of any fees, subscriptions or charges owed to the group.
              <p>The Group shall buy the member's share as soon as is financially practical, bearing in mind
                that the interests of the Group are more important than those of the expelled member, and no
                later than six months from the date of expulsion.
            <li>Liability: The operation of the Group aeroplane shall be at the risk of the member acting as Pilot-In-
              Command and in accordance with the Lease/Hire agreement at the front of this document.
              Each member hereby undertakes that he/she will not knowingly do or cause to be done any
              act that would invalidate the Group's insurance policies, and will make no claim or proceedings
              against the Group or any individual member for any act or omission or defect in respect of the
              condition of a Group aeroplane or its equipment.
            <li>Insurance: The Group shall maintain adequate insurance policies for its aeroplanes and operations as
              decided necessary by the Capital Share Owners. ( administered by Elevation Airsports Ltd )
              If as a result of an insurance claim or damages up to the value of the current excess, that
              amount is the responsibility of the member in charge of the aeroplane at that time.
              Liabilities for such excess or similar financial losses incurred by a Capital Share Member will
              result in the value of that member’s Capital Share being devalued by the appropriate amount
              as stated in para 17.
              <p>The member may elect to repay the Group the amount deducted, in
                order to revalue his/her Capital Share and reassume full membership rights as a result (subject
                to any Group decisions on the continuance of that Group member’s membership).
                Any member who is identified by the Group's insurers as a special risk may be required to
                bear any additional premium resulting from that use.
            <li>Accounts and Subscriptions: <ul>
                <li>a) It is a condition of membership that subscriptions and fees shall be paid monthly on the first
                  day of each month by banker's order or by other arrangements acceptable to the Trustee(s).
                  <ul>
                    <li>i) If a member fails to pay, he or she shall be liable to pay in addition to the overdue
                      monthly subscription payments or fees, a fine of an amount equal to the total of the
                      overdue payments.
                    <li>ii) A defaulting member may also be suspended until such time as he or she shall have
                      paid all outstanding subscriptions, fees and fines.
                    <li>iii) If such outstanding subscriptions, fees or fines remain unpaid after a period of five
                      months from the due date of the first payment, the Trustee(s) shall notify the member
                      by email giving seven days notice to pay the outstanding amount in full. If the debt
                      remains unpaid after the expiry of the seven days notification period, the share shall
                      be forfeit and passed to the group for sale to recoup the outstanding debt. Any
                      amount over and above that due to the group will be returned to the defaulting
                      member within 14 days of receipt of the payment for the share.
                  </ul>
                <li>b) Subscriptions will be based on predicted expenditure on maintenance, hangarage,
                  insurance, administration, etc. and such fees as may be necessary, but shall in any event
                  represent the most economical costing. The trustees decision is final.
                <li>c) Flying charges will be reviewed periodically by the Trustee. The charges will be based on
                  predicted costs directly incurred through flying and maintenance of adequate funds to cover
                  incidents or planned work on the aircraft. The trustees decision is final.
                  <ul>
                    <li>i) Payment for flying is to be made by cheque or electronic transfer on receipt of a
                      monthly account, or by such other method as is agreed with the Trustee.
                    <li>ii) P1 charges should be paid by the end of the month in which each member is
                      provided with details of the charges
                    <li>iii) If payment is not made within one month of such receipt the member concerned
                      may be suspended.
                  </ul>
                <li>d) An adequate reserve is to be accumulated for contingencies – e.g. engine fund,
                  replacement parts, etc. The reserve fund may be viewed as a statement by any Group
                  member upon request to the Trustee or by regular publication of such amounts by the
                  Trustee to Group members of all categories.
                <li>e) Properly kept books and accounts must be available at reasonable times for inspection by
                  members.
                <li>f) These accounts may be audited at the end of each calendar year by two members in
                  conjunction with the Trustee(s).
              </ul>
            <li>Debit Cards: Debit cards will not be issued to the Trustee(s) or nominated members for use on G.SHMI
              related matters.
            <li>Disbandment: In the event of the Group being disbanded all capital assets shall be realised and monies
              divided in relevant proportion of shares held to all Capital Share Owners, after payment of all
              outstanding debts.
            <li>Rule general revisions: The proposed alterations must be sent to all Capital Share Owners by the trustee by email
              prior to implementation to allow for suggested alterations or additions. At the end of the
              consultation period, the Trustee(s) will confirm the final draft of the rules, which will then
              supersede the previous rules.
            <li>Compliance with Regulations: All members of the Group must comply with Local and National Laws and Regulations, as
              well as the Group Rules and Operational Regulations.
              All previous Rules of the Group are hereby revoked.
              Receipt of these rules implies acceptance in whole unless the trustee is notified by email
              within 48 hours or said receipt.
          </ol>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading-av8-2">
        <h5 class="panel-title">
          <a role="button" data-toggle="collapse" class="accordion-plus-toggle collapsed" data-parent="#accordion7401210" href="#collapse-av8-2" aria-expanded="false" aria-controls="collapse-av8-2">EV-97 Pilot Operating Handbook</a>
        </h5>
      </div>
      <div id="collapse-av8-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-av8-2">
        <h4><a href="./assets/documents/EV97_POH.pdf" download="EV97_POH.pdf">Download a copy (PDF) of the EV-97 POH to your local tablet/PC</a></h4>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading411391">
        <h5 class="panel-title">
          <a role="button" data-toggle="collapse" class="accordion-plus-toggle collapsed" data-parent="#accordion7401210" href="#collapse411391" aria-expanded="false" aria-controls="collapse411391">Aircraft Insurance Document</a>
        </h5>
      </div>
      <div id="collapse411391" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading411391">
        <div class="panel-body">Will be included soon!</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading2183316">
        <h5 class="panel-title">
          <a role="button" data-toggle="collapse" class="accordion-plus-toggle collapsed" data-parent="#accordion7401210" href="#collapse2183316" aria-expanded="false" aria-controls="collapse2183316">BMAA Permit Data</a>
        </h5>
      </div>
      <div id="collapse2183316" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2183316">
        <div>
        	<table  class='table table-bordered'>
        		<caption>Aircraft Reg: SHMI</caption>
        		<thead>
        			<tr style='background-color: #f8f9d2; background-image: linear-gradient(315deg, #f8f9d2 0%, #e8dbfc 74%);'>
        				<th>COV Issue Date</th>
        				<th>Inspector         </th>
        				<th>Query Code</th>
        				<th>Reason for Query</th>
        				<th>Total Airframe Hours</th>
        				<th>COV Application Received</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr >
        				<td>
        				</td>
        				<td>
        				</td>
        				<td>EO - Owner to resolve</td>
        				<td>
        					<p>Aw001 and Aw007 required</p>
        				</td>
        				<td>0</td>
        				<td>
        				</td>
        			</tr>
        			<tr>
        				<td>07/12/2016</td>
        				<td>Mr T Willcox</td>
        				<td>
        				</td>
        				<td>
        				</td>
        				<td>2,130.55</td>
        				<td>05/12/2016</td>
        			</tr>
        			<tr>
        				<td>03/10/2017</td>
        				<td>Mr T Willcox</td>
        				<td>EO - Owner to resolve</td>
        				<td>
        					<p>Query on BMAA Membership. Emailed owner</p>
        				</td>
        				<td>2,348</td>
        				<td>27/09/2017</td>
        			</tr>
        			<tr>
        				<td>05/10/2018</td>
        				<td>Mr T Willcox</td>
        				<td>AP - Awaiting Payment</td>
        				<td>
        					<p>Awaiting payment - received</p>
        				</td>
        				<td>2,880</td>
        				<td>05/10/2018</td>
        			</tr>
        			<tr>
        				<td>15/10/2019</td>
        				<td>Mr T Willcox</td>
        				<td>
        				</td>
        				<td>
        				</td>
        				<td>2,932</td>
        				<td>14/10/2019</td>
        			</tr>
        			<tr>
        				<td>
        				</td>
        				<td>S Meester</td>
        				<td>EO - Owner to resolve, EI - Inspector to resolve, AP - Awaiting Payment</td>
        				<td>
        					<p>Query with ownership grid - email sent 05/10/2020<br>
        						Awaiting for payment - email sent 05/10/2020 - paid<br>
        						Main owner BMAA membership expired - email sent 05/10/2020<br>
        						Query on inspection - email sent 05/10/2020 - Resolved
        					</p>
        				</td>
        				<td>3,142</td>
        				<td>02/10/2020</td>
        			</tr>
        		</tbody>
        	</table>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading-av8-1">
        <h5 class="panel-title">
          <a role="button" data-toggle="collapse" class="accordion-plus-toggle collapsed" data-parent="#accordion7401210" href="#collapse-av8-1" aria-expanded="false" aria-controls="collapse-av8-1">BMAA Aircrat Data</a>
        </h5>
      </div>
      <div id="collapse-av8-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-av8-1">
        <div>
        	<table class='table table-bordered'>
        		<caption>Aircraft Reg: SHMI</caption>
        		<thead>
        			<tr style='background-color: #f8f9d2; background-image: linear-gradient(315deg, #f8f9d2 0%, #e8dbfc 74%);'>
        				<th>Date</th>
        				<th>Issue Number</th>
        				<th>Mod Type</th>
        				<th>Description</th>
        				<th>Final Approved by</th>
        				<th>Mod Approval Reference</th>
        				<th>Comments</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td>
        				</td>
        				<td>
        					<p>1</p>
        				</td>
        				<td>MAAN</td>
        				<td>
        					<p>Repairs</p>
        				</td>
        				<td>Roger Pattrick</td>
        				<td>
        					<p>2635</p>
        				</td>
        				<td>
        				</td>
        			</tr>
        			<tr>
        				<td>19/09/2014</td>
        				<td>
        				</td>
        				<td>Standard Minor</td>
        				<td>
        					<p>104 - Fitting a Transponder</p>
        				</td>
        				<td>Adrian Jones</td>
        				<td>
        					<p>/02543</p>
        				</td>
        				<td>
        				</td>
        			</tr>
        			<tr>
        				<td>
        				</td>
        				<td>
        				</td>
        				<td>Standard Minor</td>
        				<td>
        					<p>107 - Auxiliary Power Socket</p>
        				</td>
        				<td>
        				</td>
        				<td>
        				</td>
        				<td>
        				</td>
        			</tr>
        			<tr>
        				<td>
        				</td>
        				<td>
        				</td>
        				<td>Standard Minor</td>
        				<td>
        					<p>121 - PilotAware Installation</p>
        				</td>
        				<td>
        				</td>
        				<td>
        				</td>
        				<td>
        				</td>
        			</tr>
        		</tbody>
        	</table>
        </div>
      </div>
    </div>
  </div>



  <!-- jQuery -->

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

  <!-- Bootstrap 4 JavaScript -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      /* open panel where we found the first error */

      if (!$('#collapseOne .is-invalid')[0] && $('#collapseThree .is-invalid')[0]) {
        $('#collapseThree').collapse('show');
      }
    });
  </script>


</body>

</html>
