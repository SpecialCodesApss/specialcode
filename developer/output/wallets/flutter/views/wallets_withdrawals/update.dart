import 'package:framework_01_5/Controllers/Wallets_withdrawalController.dart';
import 'package:framework_01_5/helpers/LoaderDialog.dart';
import 'package:framework_01_5/helpers/ToastHelper.dart';
import 'package:framework_01_5/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/wallets.dart' as messages_ar;
import '../../lang/en/wallets.dart' as messages_en;
import 'package:framework_01_5/main.dart';
import 'package:framework_01_5/helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import 'dart:async';
import 'package:flutter/cupertino.dart';

import 'package:framework_01_5/Views/wallets_withdrawals/index.dart';

class Wallets_withdrawalsUpdate extends StatefulWidget {
  final int id;
  Wallets_withdrawalsUpdate(this.id, {Key key}) : super(key: key);
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _Wallets_withdrawalsUpdateState();
  }
}

class _Wallets_withdrawalsUpdateState extends State<Wallets_withdrawalsUpdate> {
  //declare variables here
  var language = LanguageHelper.Language;
  var data;

  Wallets_withdrawalController _Wallets_withdrawalController = new Wallets_withdrawalController();

  final TextEditingController _bank_nameController = new TextEditingController();
  final TextEditingController _account_owner_nameController = new TextEditingController();
  final TextEditingController _iban_numberController = new TextEditingController();
  final TextEditingController _account_numberController = new TextEditingController();
  final TextEditingController _withdrawal_amount_requiredController = new TextEditingController();

  _onPressedUpdate() {
    setState(() {
      showLoaderDialogFunction(context);
      if (_bank_nameController.text.trim().isNotEmpty &&
          _account_owner_nameController.text.trim().isNotEmpty &&
          _iban_numberController.text.trim().isNotEmpty &&
          _withdrawal_amount_requiredController.text.trim().isNotEmpty) {
        _Wallets_withdrawalController.update(
                widget.id,
                _bank_nameController.text.trim(),
                _account_owner_nameController.text.trim(),
                _iban_numberController.text.trim(),
                _account_numberController.text.trim(),
                _withdrawal_amount_requiredController.text.trim())
            .whenComplete(() {
          if (_Wallets_withdrawalController.status == true) {
            hideLoaderDialogFunction(context);
            ShowToast('success', _Wallets_withdrawalController.message);
            Navigator.push(context, MaterialPageRoute(builder: (context) => Wallets_withdrawalsIndex()));
          } else {
            hideLoaderDialogFunction(context);
            ShowToast('warning', _Wallets_withdrawalController.message);
          }
        });
      } else {
        hideLoaderDialogFunction(context);
        ShowToast('error',language =="en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation
          ("pleasefillallfields"));
      }
    });
  }

  read() async {
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _Wallets_withdrawalController.view(widget.id).whenComplete(() {
      if (_Wallets_withdrawalController.status == true) {
        setState(() {
          data = _Wallets_withdrawalController.data;
          _bank_nameController.text = _Wallets_withdrawalController.data["data"]["bank_name"].toString() ?? "";
          _account_owner_nameController.text =
              _Wallets_withdrawalController.data["data"]["account_owner_name"].toString() ?? "";
          _iban_numberController.text = _Wallets_withdrawalController.data["data"]["iban_number"].toString() ?? "";
          _account_numberController.text =
              _Wallets_withdrawalController.data["data"]["account_number"].toString() ?? "";
          _withdrawal_amount_requiredController.text =
              _Wallets_withdrawalController.data["data"]["withdrawal_amount_required"].toString() ?? "";
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      } else {
        ShowToast('warning', _Wallets_withdrawalController.message);
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

    return Scaffold(
        appBar: AppBar(
          title: Text(
            language =="en" ? messages_en.getTranslation("Wallets_withdrawals") : messages_ar.getTranslation
              ("Wallets_withdrawals"),
            style: Theme.of(context).textTheme.title,
          ),
          centerTitle: true,
          leading: IconButton(
            icon: Icon(Icons.arrow_back),
            onPressed: () =>
                Navigator.of(context).push(MaterialPageRoute(builder: (context) => Wallets_withdrawalsIndex())),
          ),
        ),
        body: Container(
          child: ListView(padding: EdgeInsets.all(10.0), children: <Widget>[
            TextField(
              controller: _bank_nameController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: Icon(Icons.arrow_left),
                hintText:
                language =="en" ? messages_en.getTranslation("bank_name") : messages_ar.getTranslation
                  ("bank_name"),
                labelText:
                language =="en" ? messages_en.getTranslation("bank_name") : messages_ar.getTranslation
                  ("bank_name"),
              ),
            ),
            TextField(
              controller: _account_owner_nameController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: Icon(Icons.arrow_left),
                hintText:  language =="en" ? messages_en.getTranslation("account_owner_name") : messages_ar.getTranslation
                  ("account_owner_name"),
                labelText: language =="en" ? messages_en.getTranslation("account_owner_name") : messages_ar.getTranslation
                  ("account_owner_name"),
              ),
            ),
            TextField(
              controller: _iban_numberController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: Icon(Icons.arrow_left),
                hintText:language =="en" ? messages_en.getTranslation("iban_number") : messages_ar.getTranslation
                  ("iban_number"),
                labelText: language =="en" ? messages_en.getTranslation("iban_number") : messages_ar.getTranslation
                  ("iban_number"),
              ),
            ),
            TextField(
              controller: _account_numberController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: Icon(Icons.arrow_left),
                hintText: language =="en" ? messages_en.getTranslation("account_number") : messages_ar.getTranslation
                  ("account_number"),
                labelText:language =="en" ? messages_en.getTranslation("account_number") : messages_ar.getTranslation
                  ("account_number"),
              ),
            ),
            TextField(
              controller: _withdrawal_amount_requiredController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.phone,
              decoration: InputDecoration(
                icon: Icon(Icons.arrow_left),
                hintText: language =="en" ? messages_en.getTranslation("withdrawal_amount_required") : messages_ar.getTranslation
                  ("withdrawal_amount_required"),
                labelText:language =="en" ? messages_en.getTranslation("withdrawal_amount_required") : messages_ar.getTranslation
                  ("withdrawal_amount_required"),
              ),
            ),
            SizedBox(
              height: SizeConfig.screenWidth / screenHightRatio,
            ),
            RaisedButton(
              color: Theme.of(context).primaryColor,
              child: Text(
                language =="en" ? messages_en.getTranslation("update") : messages_ar.getTranslation
                  ("update"),
                style: Theme.of(context).textTheme.button,
              ),
              onPressed: _onPressedUpdate,
            ),
          ]),
        ));
  }
}
