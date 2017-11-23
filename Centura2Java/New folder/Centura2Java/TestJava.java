








    // ! !! bedeutet, diese Funktion ist fertig


public class frmBerechnung extends cBerechnung {
      /*
Description: .._ImportVar()
          Importiert die Variablen
          2007-07-12 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
        Boolean: bSparte
      Actions
*/
    public void  _ImportVar() {
        cBerechnung._ImportVar();
    // ! Ausdrucke aufrufen
    
}


      /*
Description: .._OnClickDeckungsvorgabe()
          Ruft den Report Deckungsvorgabe auf
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
          2007-07-12 BG: einzelne Funktionen zur Berechnung durch OnClickNetto ersetzt (sind dieselben Funktionen)
          2009-07-17 BG: FIX: #3128: Zahlungsart aus Berechnung nehmen
      returns;
      Parameters
      Static Variables
      Local variables
        : oDeckungsvorgabe
          Class: cPrintDV
      Actions
*/
public void  _OnClickDeckungsvorgabe() {
//        SalWaitCursor (true);
        if (m_bZahlenvergleich = true) {
          OnClickNetto();
}
          // ! SalWaitCursor( true );
          // ! GetNetto ();
          // ! GetBrutto ();
          // ! tblOutput.SetCursorToTop ();
          // ! bBerechnet = true;
          // ! SalWaitCursor( false );
        SalTblReset( tblPrint );
        SalTblDestroyColumns (tblPrint);
        oDeckungsvorgabe.Init(tblPrint,RPT_DV);
        oDeckungsvorgabe.sZahlungsart_dat = dfsZahlungsart;
        oDeckungsvorgabe.Fill(tblPrint,Global.tblSaveEingabe);
//        SalWaitCursor (false);
    
}


      /*
Description: .._OnClickZahlenvergleich()
          Ruft den Report Zahlenvergleich auf
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
        : oZahlenvergleich
          Class: cPrintZV
      Actions
*/
public void  _OnClickZahlenvergleich() {
//        SalWaitCursor (true);
        SalTblReset( tblPrint );
        SalTblDestroyColumns (tblPrint);
        oZahlenvergleich.Init(tblPrint, RPT_ZV);
        oZahlenvergleich.sZahlungsart_dat = dfsZahlungsart;
        // ! oZahlenvergleich.Fill(tblPrint, tblOutput,frmBerechnung);
        oZahlenvergleich.Fill(tblPrint, tblOutput, m_bMitVUName );
//        SalWaitCursor (false);
    
}


      /*
Description: .._OnClickVergleich()
          Ruft den Report Vergleich auf
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
        : oVergleich
          Class: cPrintV
      Actions
*/
public void  _OnClickVergleich() {
//        SalWaitCursor (true);
        SalTblReset( tblPrint );
        SalTblDestroyColumns (tblPrint);
        oVergleich.Init(tblPrint, RPT_V);
        oVergleich.sZahlungsart_dat = dfsZahlungsart;
        oVergleich.Fill(tblPrint, tblOutput,Global.tblBerechnung,frmBerechnung, m_bMitVUName );
//        SalWaitCursor (false);
    
}


      /*
Description: .._OnClickVergleichkurz()
          Ruft den Report Vergleichkurz auf
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
        : oVergleich
          Class: cPrintV
      Actions
*/
public void  _OnClickVergleichkurz() {
//        SalWaitCursor (true);
        SalTblReset( tblPrint );
        SalTblDestroyColumns (tblPrint);
        oVergleich.Init(tblPrint, RPT_VK);
        oVergleich.sZahlungsart_dat = dfsZahlungsart;
        oVergleich.Fill(tblPrint, tblOutput,Global.tblBerechnung,frmBerechnung, m_bMitVUName );
//        SalWaitCursor (false);
    
}


      /*
Description: .._OnClickDeckungsumfang()
          Ruft den Report Deckungsumfang auf
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
        : oDeckungsumfang
          Class: cPrintDU
      Actions
*/
public void  _OnClickDeckungsumfang() {
//        SalWaitCursor (true);
        SalTblReset( tblPrint );
        SalTblDestroyColumns (tblPrint);
        oDeckungsumfang.Init(tblPrint, RPT_DU);
        oDeckungsumfang.Fill(tblPrint, tblOutput);
//        SalWaitCursor (false);
    
}


      /*
Description: .._OnClickBerechnung()
          Ruft den Report Berechnung auf
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
        : oBerechnung
          Class: cPrintB
      Actions
*/
public void  _OnClickBerechnung() {
//        SalWaitCursor (true);
        SalTblReset( tblPrint );
        SalTblDestroyColumns (tblPrint);
        oBerechnung.Init(tblPrint,RPT_B);
        oBerechnung.sZahlungsart_dat = dfsZahlungsart;
        // ! oBerechnung.Fill(tblPrint,Global.tblSaveEingabe,tblOutput,Global.tblBerechnung,frmBerechnung);
        oBerechnung.Fill(tblPrint,Global.tblSaveEingabe,tblOutput,Global.tblBerechnung);
//        SalWaitCursor (false);
    
}


      /*
Description: .._OnClickRabatte()
          Ruft die Rabatte-Maske auf
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
      Actions
*/
public void  _OnClickRabatte() {
        if (SalModalDialog( dlgRabattInfo,  hWndForm,   tblOutput.colsVGBez, tblOutput.colsPGBez, tblOutput.colnVSPProduktnr1, tblOutput.colsProdBez )) {

//          SalWaitCursor( true );
          Global.tblBerechnung.BerechneBrutto();
          // ! VisWaitCursor (false);
          SetOutput();
//          SalWaitCursor( false );
    
}


      /*
Description: .._GetNetto()
          Führt die Nettoberechnung der einzelnen Produkte durch
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
      Actions
*/
public void  _GetNetto() {
        SalTblReset( Global.tblBerechnung );
        Global.tblBerechnung.SetNetto ();
    
}


      /*
Description: .._GetBrutto()
          Führt die Bruttoberechnung der einzelnen Produkte durch
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Umstellung auf Late-Bound
      returns;
      Parameters
      Static Variables
      Local variables
        Number: nBuendel
        Boolean: bJump
      Actions
*/
public void  _GetBrutto() {
        bJump = true;
        // ! if (m_bEH = true && m_bHH = true
        //  nBuendel = 1;
        // ! else {
        //  nBuendel = 0;
        nBuendel = 0;
        if (bJump) {
          Global.tblBerechnung.SetBrutto (nBuendel, m_sZahlungsweise);
}
        bJump = true;
        if (bJump) {
          Global.tblBerechnung.BerechneBrutto ();
}
        SetOutput();
    
}


      /*
Description: es werden die Daten aus der tblBerechnung entsprechend der tblProduktkombinationen
          gesammelt und die Daten werden in tblOutput angezeigt
      returns;
      Parameters
      Static Variables
      Local variables
        Number: nRow
        Number: nRowProdukte
        String: sVGBez
        String: sVGBezkurz
        String: sPGBez
        String: sSBgen
        String: sProduktbez
        Boolean: bSonderRabatt
        Number: nVspproduktnr1
        Number: nVS1
        Number: nVSHG
        Number: nVSNG
        Number: nSBehalt1
        Number: nErgebnisJahr1
        Number: nErgebnisHalb1
        Number: nErgebnisViertel1
        Number: nErgebnisMonat1
        Number: nVspproduktnr2
        Number: nVS2
        Number: nSBehalt2
        Number: nErgebnisJahr2
        Number: nErgebnisHalb2
        Number: nErgebnisViertel2
        Number: nErgebnisMonat2
        Number: nLaufzeit
        Boolean: bSonder
        Boolean: bAdd
        Boolean: bAdd_Save
        Boolean: bEintrag
        Boolean: bEintrag1
        Boolean: bEintrag2
        Number: nFetch
        Boolean: bMindestpraemie1
        Boolean: bMindestpraemie2
      Actions
*/
public void  SetOutput() {
        SalTblReset( tblOutput );
        nRowProdukte = 0;
        bAdd = false;
        if (rbSortJahr = true) {
          dfsZahlungsart = 'JÄHRLICH';
}
        else if { rbSortHalb = true}
          dfsZahlungsart = 'HALBJÄHRLICH';
}
        else if { rbSortViertel = true}
          dfsZahlungsart = 'VIERTELJÄHRLICH';
}
        else if { rbSortMonat = true}
          dfsZahlungsart = 'MONATLICH';
}
        Loop Produkte
          if (not SalTblSetContext (Global.tblProduktkombinationen, nRowProdukte)) {
            break; Produkte
}
          bSonderRabatt = false;
          bEintrag = true;
          // ! SPARTE 1
          bEintrag1 = false;
          if (Global.tblProduktkombinationen.VSPPRODUKTNR1 > 0) {
            nRow = 0;
}
            Loop SP1
              if (not SalTblSetContext( Global.tblBerechnung, nRow )) {
                break;
}
              if (Global.tblProduktkombinationen.VSPPRODUKTNR1 = Global.tblBerechnung.colnVspproduktnr) {
                sVGBez = Global.tblBerechnung.colsVGBez;
}
                sVGBezkurz = Global.tblBerechnung.colsVGBezkurz;
                sProduktbez = Global.tblBerechnung.colsProduktBez;
                // ! 44 ist die Bedingungnr von Versicherungssumme
                GetVS(Global.tblBerechnung.colnVspproduktnr, 44, nVS1);
                sPGBez = Global.tblBerechnung.colsPgbez;
                SetOutput_Sparten (nRow, nRowProdukte, nVspproduktnr1,;
                    nErgebnisJahr1, nErgebnisHalb1, nErgebnisViertel1, nErgebnisMonat1,
                    nSBehalt1, nLaufzeit, bSonder, bAdd, bMindestpraemie1 )
                bEintrag1 = true;
                break; SP1
              nRow = nRow  1;
          if (bSonderRabatt != true) {
            bSonderRabatt = bSonder;
}
          if (bAdd = true) {
            bAdd_Save = bAdd;
}
          if (bSonderRabatt != true) {
            bSonderRabatt = bSonder;
}
          if (bAdd = true) {
            bAdd_Save = bAdd;
}
          if (Global.tblProduktkombinationen.VSPPRODUKTNR1 > 0 && bEintrag1 = false) {
            bEintrag = false;
}
          else {
            bEintrag = true;
}
          if (Global.tblProduktkombinationen.VSPPRODUKTNR2 > 0 && bEintrag2 = false) {
            bEintrag = false;
}
          else {
            bEintrag = true;
}
          // ! Füge Zeile mit allen Sparten hinzu
          if (bAdd = true && bEintrag = true && (bMindestpraemie1 = true || bMindestpraemie2 = true)) {
            tblOutput.Add (sVGBez, sVGBezkurz, sPGBez, sProduktbez, bSonderRabatt, nLaufzeit,;
}
                nVspproduktnr1, nVS1, nVSHG, nVSNG, nSBehalt1, nErgebnisJahr1, nErgebnisHalb1, nErgebnisViertel1, nErgebnisMonat1,
                COLOR_Blue)
            bAdd = false;
            bEintrag = false;
          else if { bAdd = true and bEintrag = true}
            tblOutput.Add (sVGBez, sVGBezkurz, sPGBez, sProduktbez, bSonderRabatt, nLaufzeit,;
}
                nVspproduktnr1, nVS1, nVSHG, nVSNG, nSBehalt1, nErgebnisJahr1, nErgebnisHalb1, nErgebnisViertel1, nErgebnisMonat1,
                COLOR_Black)
            bAdd = false;
            bEintrag = false;
          nRowProdukte = nRowProdukte  1;
        // ! Setze die Sicht des Fensters
        SetView ();
    
}


      /*
Description: Summiert die Daten  aus der tblBerechne und schreibt die Daten in tbl Output
      returns;
      Parameters
        Number: nRow
        Number: nRowProdukte
        Receive Number: nVspproduktnr
        Receive Number: nErgebnisJahr
        Receive Number: nErgebnisHalb
        Receive Number: nErgebnisViertel
        Receive Number: nErgebnisMonat
        Receive Number: nSB
        Receive Number: nLaufzeit
        Receive Boolean: bSonderRabatt
        Receive Boolean: bAdd
        Receive Boolean: bMindestpraemie
      Static Variables
      Local variables
        Number: nFetch
        Number: nInklVertr
      Actions
*/
public void  SetOutput_Sparten() {
        bAdd = false;
        bMindestpraemie = false;
        Loop
          if (not SalTblFindNextRow( Global.tblBerechnung, nRow, 0, 0 )) {
            break;
}
          SalTblSetContext (Global.tblBerechnung, nRow);
          // ! *** Wenn Rabatte/Zuschläge eingegeben werden, ist das Flag true;
          //    bSonderrabatt wird als Parameter an tblOutput.Add weitergegeben
          if (SalTblQueryRowFlags(Global.tblBerechnung,nRow,ROW_UnusedFlag1)) {
            bSonderRabatt=true;
}
          else {
            bSonderRabatt=false;
}
          if (Global.tblBerechnung.colnProblemanzeige > 0 && bMindestpraemie = false) {
            bMindestpraemie = true;
}
          // ! ***
          if (Global.tblBerechnung.colsArtRabatt = RAB_Brutto) {
            SqlPrepareAndExecute (hSql1,;
}
                'SELECT selbstbehalt, laufzeit FROM vspprodukt WHERE  vspproduktnr = :Global.tblBerechnung.colnVspproduktnr
                 INTO  :nSB, :nLaufzeit')
            SqlFetchNext (hSql1,nFetch);
            SqlCommit (hSql1);
            nVspproduktnr = Global.tblBerechnung.colnVspproduktnr;
            nErgebnisJahr = Global.tblBerechnung.colnErgebnis;
            nErgebnisHalb = Global.tblBerechnung.colnErgebnisHalb / 2;
            nErgebnisViertel = Global.tblBerechnung.colnErgebnisViertel / 4;
            nErgebnisMonat = Global.tblBerechnung.colnErgebnisMonat / 12;
            bAdd = true;
            break;
    
}


      /*
Description: .._XferGlobal2Output()
          Transferiert Werte Global nach tblOutput
          XXXX-XX-XX XX: Erstellung
          2007-08-28 BG: Umstellung auf late-bound
      returns;
      Parameters
      Static Variables
      Local variables
        Window Handle: hWnd
        Number: nRow
      Actions
*/
public void  _XferGlobal2Output() {
        SetOutput();
//        SalWaitCursor( true );
        SetView ();
        if (Global.bLoaded) {
          tblOutput.RestoreSelections (m_sOutputSel);
}
        if (SalTblAnyRows (tblOutput,ROW_Selected,0) && Global.bLoaded = false) {
          nRow = TBL_MinRow;
}
          m_sOutputSel = '';
          Loop
            if (SalTblFindNextRow( tblOutput, nRow, ROW_Selected, 0 )) {
              SalTblSetRowFlags( tblOutput, nRow, ROW_Selected, false );
}
              // ! SalMessageBox( 'es ist etwas selektiert', 'TEST', MB_Ok );
              nRow = nRow  1;
            else {
              break;
}
        SalTblScroll(tblOutput,0,hWndNULL,TBL_ScrollTop);
//        SalWaitCursor(false );
    
}


      /*
Description:
      returns;
        Number:
      Parameters
        Number: p_nVspproduktnr
        Number: p_nBedingungnr
        Receive Number: r_nWert
      Static Variables
      Local variables
        String: sSQL
        Number: nFetch
        String: sListe
        String: sWert
      Actions
*/
public void  GetVS() {
        GetProduktpaketliste (p_nVspproduktnr, sListe);
        if (p_nVspproduktnr > 0 && sListe != STRING_Null) {
          sSQL = 'SELECT pd.wert FROM bedingung b, produktdu pd, produktpaket pp, vspprodukt vsp ;
}
              WHERE bedingungnr = :p_nBedingungnr
              AND b.deckungsumfangnr = pd.deckungsumfangnr
              AND pd.produktpaketnr = pp.produktpaketnr 
              AND pp.produktnr = vsp.produktnr
              AND vsp.vspproduktnr = :p_nVspproduktnr
              AND pp.produktpaketnr in (' || sListe || ')
              INTO :sWert
              '
          SqlPrepareAndExecute( hSql2, sSQL );
          if (SqlFetchNext( hSql2, nFetch )) {
            SqlCommit( hSql2 );
}
            if (sWert = '1' || sWert = '2') {
              r_nWert = NUMBER_Null;
}
            else {
              r_nWert = SalStrToNumber( sWert );
}
            return true;
          else {
            SqlCommit( hSql2 );
}
            return false;
        else {
          return false;
}
    
}


      /*
Description:
      returns;
      Parameters
        Number: p_nVspproduktnr
        Receive String: r_sListe
      Static Variables
      Local variables
      Actions
*/
public void  GetProduktpaketliste() {
        if (p_nVspproduktnr > 0) {
          GetListe (p_nVspproduktnr, r_sListe, Global.tblVSPProdukte);
}
        else {
          r_sListe = '';
}
        // ! if (p_nVspproduktnr2 > 0
        //  GetListe (p_nVspproduktnr2, r_sListe2, Global.tblVSPProdukte);
        // ! else {
        //  r_sListe2 = '';
    
}


      /*
Description:
      returns;
      Parameters
        Number: p_nVspproduktnr
        Receive String: r_sListe
        Window Handle: hTable
      Static Variables
      Local variables
        Number: nRow
      Actions
*/
public void  GetListe() {
        nRow = -1;
        nRow = VisTblFindNumber (hTable,0,hTable.VSPProduktnr,p_nVspproduktnr);
        SalTblSetContext( hTable, nRow );
        r_sListe = hTable.Produktpakete;
    // ! 
}


      /*
Description: .._ShowColumns()
          Zeigt/Versteckt die Columns nach den Checkboxen
          200X-XX-XX XX: Erstellung
          2007-07-11 BG: Late-bound-Umstellung
          2007-08-28 BG: Aus tblOutput herausgenommen, weil unter Vista Fehler auftreten
      returns ;
      Parameters 
      Static Variables 
      Local variables 
        : oDebug
.winattr class
          Class: cDebug
.end
      Actions
*/ 
public void  _ShowColumns() {
        cBerechnung._ShowColumns();
  Window Parameters
  Window Variables
    // ! Ausdrucke - vorerst auskommentieren, bis EH-Ausdrucke gemacht werden
    File Handle: m_hFile
    Boolean: m_bMitVUName
  Message Actions
    // ! On NAV_EnableDU
    //  return true;
}
}