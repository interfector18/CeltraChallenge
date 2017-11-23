package com.rathberger.anbot.rs.bean;

import java.awt.SystemColor;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;

import net.sf.jasperreports.engine.JRParameter;

import com.rathberger.anbot.AbstractAnbot;
import com.rathberger.anbot.CBerechnung;
import com.rathberger.anbot.CGlobal;
import com.rathberger.anbot.arrays.TblProduktkombinationen;
import com.rathberger.anbot.impl.Berechnung;
import com.rathberger.anbot.impl.Output;
import com.rathberger.anbot.impl.Produktkombinationen;
import com.rathberger.anbot.rs.bean.report.CPrintB;
import com.rathberger.anbot.rs.bean.report.CPrintDU;
import com.rathberger.anbot.rs.bean.report.CPrintDV;
import com.rathberger.anbot.rs.bean.report.CPrintV;
import com.rathberger.anbot.rs.bean.report.CPrintZV;
import com.rathberger.converter.NumberUtil;
import com.rathberger.converter.ObjectUtil;
import com.rathberger.delegate.DelegateBean;
import com.rathberger.service.RTVServiceLocator;
import com.rathberger.util.TableArrayList;
import com.rathberger.util.TableRowFlagConstants;
import com.rathberger.util.Utils;
import com.rathberger.web.datatablescroller.RowProperty;
import com.rathberger.web.report.ReportBean;

public class FrmBerechnung extends CBerechnung {
  
  public static final String RPT_VK  = "RPT_VK";

  private static final String RPT_B  = "rs/berechnung";
  private static final String RPT_DU = "rs/du";
  private static final String RPT_DV = "rs/dv";
  public  static final String RPT_V  = "rs/vergleich";
  private static final String RPT_ZV = "rs/zvergleich";
  
  private AbstractAnbot anbotBean = null;

  public  static final short STATISTIC_RPT_B  = 211; //'RS-Anbot Berechnung: Report Berechnung'
  public  static final short STATISTIC_RPT_DU = 212; //'RS-Anbot Berechnung: Report Deckungsumfang'
  public  static final short STATISTIC_RPT_DV = 213; //'RS-Anbot Berechnung: Report Deckungsvorgabe'
  public  static final short STATISTIC_RPT_V  = 214; //'RS-Anbot Berechnung: Report Vergleich'
  public  static final short STATISTIC_RPT_ZV = 215; //'RS-Anbot Berechnung: Report Zahlenvergleich'
 
  public FrmBerechnung(AbstractAnbot anbotBean) {
    super(anbotBean, CGlobal.RECHTSSCHUTZ);
    this.anbotBean = anbotBean;
  }

/*
    Description: .._GetBrutto(  )() {
        Führt die Bruttoberechnung der einzelnen Produkte durch
        200X-XX-XX XX: Erstellung
        2007-07-11 BG: Umstellung auf Late-Bound
    Returns
    Parameters
    Static Variables
    Local variables
      Number: nBuendel
      Boolean: bJump
    Actions
*/      
  @Override
  public void _GetBrutto() {
      //bJump = true;
      //! if (m_bEH = true; and m_bHH = true;
      //  nBuendel = 1
      //! else
      //  nBuendel = 0
      int nBuendel = 0;
      //if (bJump
      getGlobal().getTblBerechnung().setBrutto(nBuendel, m_sZahlungsweise);
      //bJump = true;
      //if (bJump
      getGlobal().getTblBerechnung().berechneBrutto();
      setOutput();
  }
  
/*
    Description: es werden die Daten aus der tblBerechnung entsprechend der tblProduktkombinationen
        gesammelt und die Daten werden in tblOutput angezeigt
    returns
    Parameters
    Static Variables
    Local variables
    Actions
*/      
  @Override
  public void setOutput() {
      int      nRow             = 0;
      int      nRowProdukte     = 0;
      String   sVGBez           = "";
      String   sVGBezkurz       = "";
      String   sPGBez           = "";
      String   sSBgen           = "";
      String   sProduktbez      = "";
      Boolean  bSonderRabatt    = false;
      Integer  nVspproduktnr1   = 0;
      Double   nVS1             = 0.0;
      Double   nVSHG            = 0.0;
      Double   nVSNG            = 0.0;
      Double   nSBehalt1        = 0.0;
      Double   nErgebnisJahr1   = 0.0;
      Double   nErgebnisHalb1   = 0.0;
      Double   nErgebnisViertel1= 0.0;
      Double   nErgebnisMonat1  = 0.0;
      Double   nVspproduktnr2   = 0.0;
      Double   nVS2             = 0.0;
      Double   nSBehalt2        = 0.0;
      Double   nErgebnisJahr2   = 0.0;
      Double   nErgebnisHalb2   = 0.0;
      Double   nErgebnisViertel2= 0.0;
      Double   nErgebnisMonat2  = 0.0;
      Double   nLaufzeit        = 0.0;
      Boolean  bSonder          = false;
      Boolean  bAdd             = false;
      Boolean  bAdd_Save        = false;
      Boolean  bEintrag         = false;
      Boolean  bEintrag1        = false;
      Boolean  bEintrag2        = false;
      //int      nFetch          ;
      boolean  bMindestpraemie1 = false;
      boolean  bMindestpraemie2 = false;

      getTblOutput().clear(); // Ako je null da se inicijalizira
      nRowProdukte = 0;
      bAdd = false;
      if (isRbSortJahr())
        dfsZahlungsart = "JÄHRLICH";
      else if (isRbSortHalb())
        dfsZahlungsart = "HALBJÄHRLICH";
      else if (isRbSortViertel())
        dfsZahlungsart = "VIERTELJÄHRLICH";
      else if (isRbSortMonat())
        dfsZahlungsart = "MONATLICH";
      
      TblProduktkombinationen tblProduktkombinationen = global.getTblProduktkombinationen();
      while (tblProduktkombinationen.setRowPos(nRowProdukte)) {
        Produktkombinationen produktkombinationen = tblProduktkombinationen.getRow();
        bSonderRabatt = false;
        bEintrag = true;
        //! SPARTE 1
        bEintrag1 = false;
        if (produktkombinationen.getVspproduktnr1() > 0) {
          nRow = 0;
          TableArrayList<Berechnung> tblBerechnung = global.getTblBerechnung();
          while (tblBerechnung.setRowPos(nRow)) {
            Berechnung berechnung = tblBerechnung.getRow();  
          //Loop SP1
            if (ObjectUtil.equals(produktkombinationen.getVspproduktnr1(), berechnung.getVspproduktnr())) {
              sVGBez = berechnung.getVgBez();
              sVGBezkurz = berechnung.getVgBezkurz();
              sProduktbez = berechnung.getProduktBez();
              //! 44 ist die Bedingungnr von Versicherungssumme
              nVS1 = getVS(berechnung.getVspproduktnr(), 44/*, nVS1*/);
              sPGBez = berechnung.getPgbez();
              Output_Sparten output_Sparten = setOutput_Sparten (
                  nRow, 
                  nRowProdukte, 
                  nVspproduktnr1, 
                  nErgebnisJahr1, 
                  nErgebnisHalb1, 
                  nErgebnisViertel1, 
                  nErgebnisMonat1,
                  nSBehalt1, 
                  nLaufzeit, 
                  bSonder, 
                  bAdd, 
                  bMindestpraemie1
                );
              nVspproduktnr1 = output_Sparten.nVspproduktnr;
              nErgebnisJahr1 = output_Sparten.nErgebnisJahr; 
              nErgebnisHalb1 = output_Sparten.nErgebnisHalb;
              nErgebnisViertel1 = output_Sparten.nErgebnisViertel; 
              nErgebnisMonat1 = output_Sparten.nErgebnisMonat;
              nSBehalt1 = output_Sparten.nSB;
              nLaufzeit = output_Sparten.nLaufzeit;
              bSonder = output_Sparten.bSonderRabatt;
              bAdd = output_Sparten.bAdd;
              bMindestpraemie1 = output_Sparten.bMindestpraemie;

              bEintrag1 = true;
              break; //SP1
            }
            nRow = nRow + 1;
          }
        }
        if (!bSonderRabatt)
          bSonderRabatt = bSonder;
        if (bAdd)
          bAdd_Save = bAdd;
        if (!bSonderRabatt)
          bSonderRabatt = bSonder;
        if (bAdd)
          bAdd_Save = bAdd;
        if (produktkombinationen.getVspproduktnr1() > 0 && !bEintrag1)
          bEintrag = false;
        else
          bEintrag = true;
        if (produktkombinationen.getVspproduktnr2() > 0 && !bEintrag2)
          bEintrag = false;
        else
          bEintrag = true;
        //! Füge Zeile mit allen Sparten hinzu
        if (bAdd && bEintrag && (bMindestpraemie1 || bMindestpraemie2)) {
          tblOutput.add(sVGBez, sVGBezkurz, sPGBez, sProduktbez, bSonderRabatt, NumberUtil.getAsDouble(nLaufzeit),
              nVspproduktnr1, NumberUtil.getAsDouble(nVS1), NumberUtil.getAsDouble(nVSHG), NumberUtil.getAsDouble(nVSNG), NumberUtil.getAsDouble(nSBehalt1), NumberUtil.getAsDouble(nErgebnisJahr1), NumberUtil.getAsDouble(nErgebnisHalb1), NumberUtil.getAsDouble(nErgebnisViertel1), NumberUtil.getAsDouble(nErgebnisMonat1),
              0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0,
              SystemColor.blue.getRGB());
          bAdd = false;
          bEintrag = false;
        } else if (bAdd && bEintrag) {
          tblOutput.add(sVGBez, sVGBezkurz, sPGBez, sProduktbez, bSonderRabatt, NumberUtil.getAsDouble(nLaufzeit),
              nVspproduktnr1, NumberUtil.getAsDouble(nVS1), NumberUtil.getAsDouble(nVSHG), NumberUtil.getAsDouble(nVSNG), NumberUtil.getAsDouble(nSBehalt1), NumberUtil.getAsDouble(nErgebnisJahr1), NumberUtil.getAsDouble(nErgebnisHalb1), NumberUtil.getAsDouble(nErgebnisViertel1), NumberUtil.getAsDouble(nErgebnisMonat1),
              0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0,
              SystemColor.black.getRGB());
          bAdd = false;
          bEintrag = false;
        }
        nRowProdukte = nRowProdukte + 1;
      }
      //! Setze die Sicht des Fensters
      //SetView ()
      
    Collections.sort(tblOutput, new Comparator<Output>() {
      @Override
      public int compare(Output o1, Output o2) {
        return o1.getGesamt().compareTo(o2.getGesamt());
      }
    });

    getRowProperies().clear();

    nRow = 0;
    for (Output output : tblOutput) {
      if (output.getRowColor()!=null) {
        if (output.getRowColor().intValue()== SystemColor.red.getRGB()) 
        setRowProperty(nRow, RowProperty.ROWCLASS, "COLOR_Red");
        else if (output.getRowColor().intValue()== SystemColor.green.getRGB()) 
          setRowProperty(nRow, RowProperty.ROWCLASS, "COLOR_Green");
        else if (output.getRowColor().intValue()== SystemColor.blue.getRGB()) 
          setRowProperty(nRow, RowProperty.ROWCLASS, "COLOR_Blue");
        else
          setRowProperty(nRow, RowProperty.ROWCLASS, "COLOR_Black");
      }
      nRow++;
    }
  }

  private class Output_Sparten {
    int     nRow             ;
    int     nRowProdukte     ;
    Integer nVspproduktnr;
    Double nErgebnisJahr;
    Double nErgebnisHalb;
    Double nErgebnisViertel;
    Double nErgebnisMonat;
    Double nSB;
    Double nLaufzeit;
    boolean bSonderRabatt;
    boolean bAdd;
    boolean bMindestpraemie;
    
    public Output_Sparten() {
      super();
    }
  }

  
/*
    Description: Summiert die Daten  aus der tblBerechne und schreibt die Daten in tbl Output
    returns
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
  public Output_Sparten setOutput_Sparten(
      int nRow,
      int nRowProdukte,
      Integer nVspproduktnr,
      Double nErgebnisJahr,
      Double nErgebnisHalb,
      Double nErgebnisViertel,
      Double nErgebnisMonat,
      Double nSB,
      Double nLaufzeit,
      boolean bSonderRabatt,
      boolean bAdd,
      boolean bMindestpraemie
      ) {
      bAdd = false;
      bMindestpraemie = false;
      TableArrayList<Berechnung> tblBerechnung = global.getTblBerechnung();
      while (tblBerechnung.setRowPos(++nRow)) {
      //Loop
        //if (not SalTblFindNextRow( Global.tblBerechnung, nRow, 0, 0 )
        //  break
        //SalTblSetContext (Global.tblBerechnung, nRow)
        //! *** Wenn Rabatte/Zuschläge eingegeben werden, ist das Flag true;;
        //    bSonderrabatt wird als Parameter an tblOutput.Add weitergegeben
        Berechnung berechnung = tblBerechnung.getRow();
        if (berechnung.getRowFlag()==TableRowFlagConstants.ROW_UnusedFlag1)
          bSonderRabatt=true;
        else
          bSonderRabatt=false;

        if (NumberUtil.getAsDouble(berechnung.getProblemanzeige()).doubleValue() > 0.0 && !bMindestpraemie)
          bMindestpraemie = true;
        //! ***
        if (CGlobal.RAB_Brutto.equals(berechnung.getArtRabatt())) { 
          String hSql1 = "SELECT selbstbehalt, laufzeit FROM "+global.getModulKuerzel()+".vspprodukt WHERE  vspproduktnr = " + berechnung.getVspproduktnr();
          //               INTO :nSB, :nLaufzeit")
          List<Object[]> selItems = (List<Object[]>)new DelegateBean(Berechnung.class.getSimpleName(), RTVServiceLocator.ANBOT_SERVICE).getAllItemsByNativeSQL(hSql1, null);
          if (selItems!=null && selItems.size()>0) {
            nSB       = NumberUtil.getAsDouble((Number)selItems.get(0)[0], true).doubleValue();
            nLaufzeit = NumberUtil.getAsDouble((Number)selItems.get(0)[1], true).doubleValue();
          }
          //SqlFetchNext (hSql1,nFetch)
          //SqlCommit (hSql1)
          nVspproduktnr = berechnung.getVspproduktnr();
          nErgebnisJahr = berechnung.getErgebnis();
          nErgebnisHalb = berechnung.getErgebnisHalb() / 2.0;
          nErgebnisViertel = berechnung.getErgebnisViertel() / 4.0;
          nErgebnisMonat = berechnung.getErgebnisMonat() / 12.0;
          bAdd = true;
          break;
        }
      }
      Output_Sparten output_Sparten = new Output_Sparten();
      output_Sparten.nRow             = nRow            ;
      output_Sparten.nRowProdukte     = nRowProdukte    ;
      output_Sparten.nVspproduktnr = nVspproduktnr;
      output_Sparten.nErgebnisJahr =nErgebnisJahr;
      output_Sparten.nErgebnisHalb =nErgebnisHalb;
      output_Sparten.nErgebnisViertel =nErgebnisViertel;
      output_Sparten.nErgebnisMonat =nErgebnisMonat;
      output_Sparten.nSB =nSB;
      output_Sparten.nLaufzeit =nLaufzeit;
      output_Sparten.bSonderRabatt =bSonderRabatt;
      output_Sparten.bAdd =bAdd;
      output_Sparten.bMindestpraemie =bMindestpraemie;
      
     return output_Sparten;   
  }
  
/*
    Description: .._XferGlobal2Output()
        Transferiert Werte Global nach tblOutput
        XXXX-XX-XX XX: Erstellung
        2007-08-28 BG: Umstellung auf late-bound
    returns
    Parameters
    Static Variables
    Local variables
      Window Handle: hWnd
      Number: nRow
    Actions
*/      
  @Override
  public void _XferGlobal2Output() {
      setOutput();
      //SalWaitCursor( true; )
      /*
      setView();
      if (Global.bLoaded
        tblOutput.RestoreSelections (m_sOutputSel)
      if (SalTblAnyRows (tblOutput,ROW_Selected,0) and Global.bLoaded = false;
        nRow = TBL_MinRow
        m_sOutputSel = ""
        Loop
          if (SalTblFindNextRow( tblOutput, nRow, ROW_Selected, 0 )
            SalTblSetRowFlags( tblOutput, nRow, ROW_Selected, false; )
            //! SalMessageBox( "es ist etwas selektiert", "TEST", MB_Ok )
            nRow = nRow + 1
          else
            break
      SalTblScroll(tblOutput,0,hWndNULL,TBL_ScrollTop)
      SalWaitCursor(false; )
      */
  }
  
/*
    Description:
    returns
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
  public Double getVS(Integer p_nVspproduktnr, Integer p_nBedingungnr) {
      String sListe = getProduktpaketliste(p_nVspproduktnr/*, sListe*/);
      Double r_nWert = null;
      if (p_nVspproduktnr > 0 && sListe != null) {
        String sSQL = "SELECT pd.wert"
            + " FROM stamm.bedingung b, rs.produktdu pd, rs.produktpaket pp, rs.vspprodukt vsp "
            +" WHERE bedingungnr = " + p_nBedingungnr
            +" AND b.deckungsumfangnr = pd.deckungsumfangnr"
            +" AND pd.produktpaketnr = pp.produktpaketnr "
            +" AND pp.produktnr = vsp.produktnr"
            +" AND vsp.vspproduktnr = "+ p_nVspproduktnr
            +" AND pp.produktpaketnr in (" + sListe + ")"
            +" AND b.modulkuerzel = '"+ global.getModulKuerzel() +"'";
            //+" INTO :sWert
            ;
        //SqlPrepareAndExecute( hSql2, sSQL )
        List<Number> selItems = (List<Number>)new DelegateBean(Berechnung.class.getSimpleName(), RTVServiceLocator.ANBOT_SERVICE).getAllItemsByNativeSQL(sSQL, null);
        if (selItems!=null && selItems.size()>0) {
          double nWert = NumberUtil.getAsDouble(selItems.get(0)).intValue(); 
          if (1.0 == nWert || 2.0 == nWert)
            r_nWert = null;
          else
            r_nWert = nWert;
        }
      }
      return r_nWert;
  }
  
/*
    Description:
    returns
    Parameters
      Number: p_nVspproduktnr
      Receive String: r_sListe
    Static Variables
    Local variables
    Actions
*/      
  public String getProduktpaketliste(Integer p_nVspproduktnr) {
    String r_sListe = "";
      if (p_nVspproduktnr > 0)
        r_sListe = getListe(p_nVspproduktnr/*, r_sListe*/, global.getTblVSPProdukte());
      else
        r_sListe = "";
      //! if (p_nVspproduktnr2 > 0
      //  GetListe (p_nVspproduktnr2, r_sListe2, Global.tblVSPProdukte)
      //! else
      //  r_sListe2 = ""
    return r_sListe;    
  }
/*
    Description:
    returns
    Parameters
      Number: p_nVspproduktnr
      Receive String: r_sListe
      Window Handle: hTable
    Static Variables
    Local variables
      Number: nRow
    Actions
*/      
  public String getListe(Integer p_nVspproduktnr, TableArrayList<?> hTable) {
    int nRow = hTable.find(0, "getVspProduktnr", ""+p_nVspproduktnr);
    //  nRow = -1
    //  nRow = VisTblFindNumber (hTable,0,hTable.VSPProduktnr,p_nVspproduktnr)
    //  SalTblSetContext( hTable, nRow )
    if (nRow>=0)
      return hTable.getValue("Produktpakete");
    else
      return null;
  }

  @Override
  public void onClickBerechnung() {
    takeSelection();
    // oReport.Init( tblPrint, RPT_B )
    // oReport.Fill( tblPrint, Global.tblSaveEingabe, tblOutput, Global.tblBerechnung, frmBerechnung, dfsZahlungsart )
    ReportBean reportBean = new ReportBean();
    reportBean.setReportName(RPT_B);

    CPrintB cPrintB = new CPrintB(anbotBean.getGlobal(), anbotBean.getContact(), this, anbotBean.getGlobal().getTblSaveEingabe(), getTblOutput(), anbotBean.getGlobal().getTblBerechnung());
    cPrintB.sZahlungsart_dat = dfsZahlungsart;
        //, anbotBean.getGlobal().getTblSaveEingabe(), getTblOutput(), anbotBean.getGlobal().getTblBerechnung(), this, dfsZahlungsart);
    //cPrintB.fill();
    reportBean.setDataSource(cPrintB);
    Map<String, Object> parameters = new HashMap<String, Object>();
    parameters.put(JRParameter.REPORT_LOCALE, Locale.GERMAN);
    reportBean.setParameters(cPrintB.initParameters(parameters));
    try {
      reportBean.getReport();
      Utils.createBusinessStatisctics(null, (short)STATISTIC_RPT_B); //Statistics: KFZ-Anbot Berechnung: Report Berechnung
    } catch (Exception e1) {
      e1.printStackTrace();
    }
  }

  @Override
  public void onClickDeckungsumfang() {
    takeSelection();
    //oReport.Init( tblPrint, RPT_DU )
    //oReport.Fill( tblPrint, tblOutput, frmBerechnung, dfsZahlungsart )
    ReportBean reportBean = new ReportBean();
    reportBean.setReportName(RPT_DU);
    CPrintDU cPrintDU = new CPrintDU(anbotBean.getGlobal(), anbotBean.getContact(), this);
    cPrintDU.sZahlungsart_dat = dfsZahlungsart;
    //cPrintDU.fill();
    reportBean.setDataSource(cPrintDU);
    Map<String, Object> parameters = new HashMap<String, Object>();
    parameters.put(JRParameter.REPORT_LOCALE, Locale.GERMAN);
    reportBean.setParameters(cPrintDU.initParameters(parameters));
    try {
      reportBean.getReport();
      Utils.createBusinessStatisctics(null, (short)STATISTIC_RPT_DU); //Statistics: KFZ-Anbot Berechnung: Report Deckungsumfang
    } catch (Exception e1) {
      e1.printStackTrace();
    }
  }

  @Override
  public void onClickDeckungsvorgabe() {
    takeSelection();
    ReportBean reportBean = new ReportBean();
    reportBean.setReportName(RPT_DV);

    CPrintDV cPrintDV = new CPrintDV(anbotBean.getGlobal(), anbotBean.getContact());
    cPrintDV.sZahlungsart_dat = dfsZahlungsart;
    //cPrintDV.fill();
    reportBean.setDataSource(cPrintDV);
    Map<String, Object> parameters = new HashMap<String, Object>();
    parameters.put(JRParameter.REPORT_LOCALE, Locale.GERMAN);
    reportBean.setParameters(cPrintDV.initParameters(parameters));
    try {
      reportBean.getReport();
      Utils.createBusinessStatisctics(null, (short)STATISTIC_RPT_DV); //Statistics: RS-Anbot Berechnung: Report Deckungsvorgabe
    } catch (Exception e1) {
      e1.printStackTrace();
    }
  }

  @Override
  public void onClickVergleich() {
    takeSelection();
    // oReport.Init( tblPrint, RPT_V )
    // oReport.Fill( tblPrint, tblOutput, Global.tblBerechnung, frmBerechnung, bMitVUName, dfsZahlungsart )
    ReportBean reportBean = new ReportBean();
    reportBean.setReportName(RPT_V);
    CPrintV cPrintV = new CPrintV(anbotBean.getGlobal(), anbotBean.getContact(), this, !getbMitVUName());
        //anbotBean.getGlobal(), anbotBean.getContact(), getTblOutput(), anbotBean.getGlobal().getTblBerechnung(), this, !bMitVUName, dfsZahlungsart);
    cPrintV.sZahlungsart_dat = dfsZahlungsart;
    //cPrintV.fill();
    reportBean.setDataSource(cPrintV);
    Map<String, Object> parameters = new HashMap<String, Object>();
    parameters.put(JRParameter.REPORT_LOCALE, Locale.GERMAN);
    reportBean.setParameters(cPrintV.initParameters(parameters));
    try {
      reportBean.getReport();
      Utils.createBusinessStatisctics(null, (short)STATISTIC_RPT_V); //Statistics: KFZ-Anbot Berechnung: Report Kfzvergleich
    } catch (Exception e1) {
      e1.printStackTrace();
    }
  }

  @Override
  public void onClickZahlenvergleich() {
    takeSelection();
    // oReport.Init( tblPrint, RPT_ZV )
    // oReport.Fill( tblPrint, tblOutput, frmBerechnung, bMitVUName, dfnMVSt, dfsZahlungsart )
    ReportBean reportBean = new ReportBean();
    reportBean.setReportName(RPT_ZV);
    CPrintZV cPrintZV = new CPrintZV(anbotBean.getGlobal(), anbotBean.getContact(), this, !getbMitVUName());
    cPrintZV.sZahlungsart_dat = dfsZahlungsart;
    //cPrintZV.Fill();
    reportBean.setDataSource(cPrintZV);
    Map<String, Object> parameters = new HashMap<String, Object>();
    parameters.put(JRParameter.REPORT_LOCALE, Locale.GERMAN);
    reportBean.setParameters(cPrintZV.initParameters(parameters));
    try {
      reportBean.getReport();
      Utils.createBusinessStatisctics(null, (short)STATISTIC_RPT_ZV); //Statistics: KFZ-Anbot Berechnung: Report Zahlenvergleich
    } catch (Exception e1) {
      e1.printStackTrace();
    }
  }
             

            
}
