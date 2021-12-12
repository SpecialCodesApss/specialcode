import 'package:flutter/cupertino.dart';
import '../../packages/hexcolor/hexcolor.dart';
import 'package:framework_01_5/Controllers/WalletController.dart';
//import 'package:framework_01_5/Views/paytabs/pay.dart';
import 'package:framework_01_5/helpers/LoaderDialog.dart';
import 'package:framework_01_5/helpers/ToastHelper.dart';
import 'package:framework_01_5/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/wallets.dart' as messages_ar;
import '../../lang/en/wallets.dart' as messages_en;
import 'package:framework_01_5/main.dart';
import 'package:framework_01_5/helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
//import 'package:carousel_slider/carousel_slider.dart';

class ChargeWallet extends StatefulWidget {
  ChargeWallet({Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _ChargeWalletState();
  }
}

class _ChargeWalletState extends State<ChargeWallet> {
  //declare variables here
  var language = LanguageHelper.Language;
  final List<String> imgList = [];
  bool ViewImage = false;
  String ViewedImageType = "static";
  var data;
  var wallet_id;
  String balance;

  WalletController _WalletController = new WalletController();
  TextEditingController _amountController = new TextEditingController();

  chargeWallet() async {
    if (_amountController.text.isNotEmpty) {
      var amount = _amountController.text.trim();
      //routing to charge amount with credit card

//      Navigator.of(context).push(MaterialPageRoute(
//          builder: (context) => Pay('wallet_$wallet_id', amount)));
    }
  }

  read() async {
    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _WalletController.view().whenComplete(() {
      if (_WalletController.status == true) {
        setState(() {
          data = _WalletController.data;
          wallet_id = data["data"]["wallet_id"];
          print(wallet_id);
          balance=data["data"]['wallet_balance'].toStringAsFixed(2);
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      } else {
        ShowToast('warning', _WalletController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }

  @override
  initState() {
    super.initState();
    read();
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio = 20;
    if (SizeConfig.orientation == Orientation.landscape) {
      screenWidthRatio = 20;
      screenHightRatio = 55;

      contenttopalignmentratio = 10;
    } else {
      screenWidthRatio = 10;
      screenHightRatio = 35;

      contenttopalignmentratio = 3;
    }

    return  Scaffold(
      backgroundColor: Hexcolor('f0f0f0'),
        appBar: AppBar(
          title: Text(
            language =="en" ? messages_en.getTranslation("chargeWallet") : messages_ar.getTranslation
              ("chargeWallet"),
            style: Theme.of(context).textTheme.title,
          ),
          centerTitle: true,
          leading: IconButton(
            icon: Icon(Icons.arrow_back),
            onPressed: () => Navigator.of(context).pop(),
          ),
        ),
        body: Container(
            decoration: BoxDecoration(
              /*image: DecorationImage(
            image: AssetImage("assets/images/bg.png"),
            fit: BoxFit.cover,
          ),*/
            ),
          padding: EdgeInsets.all(30.0),
            child: data != null
              ? ListView(
                  padding: EdgeInsets.all(5.0),
                  children: <Widget>[
                    Container(
                      child: Card(
                          color: Colors.white.withOpacity(0.8),
                          child: Padding(
                            padding: EdgeInsets.all(20.0),
                            child: Column(
                              children: <Widget>[
                                Padding(
                                  padding: EdgeInsets.only(
                                      left: 10.0,
                                      right: 10.0,
                                      top: 30.0,
                                      bottom: 20.0),
                                  child: Center(
                                    child: Text(
                                      language =="en" ? messages_en.getTranslation("wallet_balance") : messages_ar.getTranslation
                                        ("wallet_balance"),
                                      style: TextStyle(
                                        fontWeight: FontWeight.bold,
                                        fontSize: 18.0,
                                        color: Colors.black,
                                      ),
                                    ),
                                  ),
                                ),
                                Center(
                                  child: Text(
                                    balance +
                                        language =="en" ? messages_en.getTranslation("SARcurrency") : messages_ar.getTranslation
                                      ("SARcurrency"),
                                    style: TextStyle(
                                      fontWeight: FontWeight.bold,
                                      fontSize: 40.0,
                                      color: Colors.green,
                                    ),
                                  ),
                                ),
                                SizedBox(
                                  height: 20,
                                ),
                                Column(
                                  children: <Widget>[
                                    TextFormField(
                                      controller: _amountController,
                                      keyboardType: TextInputType.phone,
                                      style: Theme.of(context).textTheme.body1,
                                      decoration: InputDecoration(
                                        hintText: language =="en" ? messages_en.getTranslation("chargeAmount") : messages_ar.getTranslation
                                          ("chargeAmount"),
                                        icon:
                                            Icon(Icons.account_balance_wallet),
                                      ),
                                    ),
                                  ],
                                ),
                                Padding(
                                  padding: EdgeInsets.only(
                                      top: 50.0, left: 30.0, right: 30.0),
                                  child: ButtonTheme(
                                    minWidth: double.infinity,
                                    child: RaisedButton(
                                        child: Text(
                                          language =="en" ? messages_en.getTranslation("payUsingCC") : messages_ar.getTranslation
                                            ("payUsingCC"),
                                          style: Theme.of(context).textTheme.button,
                                        ),
                                        onPressed: chargeWallet),
                                    buttonColor: Hexcolor('232323'),
                                  ),


                                )
                              ],
                            ),
                          )),
                    ),
                  ],
                )
              : null,
        ));
  }
}
