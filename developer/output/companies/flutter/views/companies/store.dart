import '../../Controllers/CompanieController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/companies.dart' as messages_ar;
import '../../lang/en/companies.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'dart:async';
import 'dart:io';
import 'package:flutter/cupertino.dart';
import 'package:flutter/src/widgets/basic.dart';
import 'package:image_picker/image_picker.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:smart_select/smart_select.dart';

import '../../Views/companies/index.dart';

class CompaniesStore extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _CompaniesStoreState();
  }
}

class _CompaniesStoreState extends State<CompaniesStore> {
  //declare variables here


  var language = LanguageHelper.Language;
  var data;

  File logo_image;
  Future getImage() async {
    //focusout from keyboard - its important due to error happen when load image thats clear last textfield
    FocusScopeNode currentFocus = FocusScope.of(context);
    if (!currentFocus.hasPrimaryFocus) {
      currentFocus.unfocus();
    }

    var image = await ImagePicker.pickImage(source: ImageSource.gallery);
    setState(() {
      logo_image = image;
    });
  }

  CompanieController _CompanieController = new CompanieController();

  final TextEditingController _categoriesController =
      new TextEditingController();
  final TextEditingController _country_idController =
      new TextEditingController();
  final TextEditingController _city_idController = new TextEditingController();
  final TextEditingController _slugController = new TextEditingController();
  final TextEditingController _company_name_arController =
      new TextEditingController();
  final TextEditingController _company_name_enController =
      new TextEditingController();
  final TextEditingController _description_arController =
      new TextEditingController();
  final TextEditingController _description_enController =
      new TextEditingController();
  final TextEditingController _emailController = new TextEditingController();
  final TextEditingController _phone_numberController =
      new TextEditingController();
  final TextEditingController _whatsapp_numberController =
      new TextEditingController();
  final TextEditingController _website_linkController =
      new TextEditingController();
  final TextEditingController _addressController = new TextEditingController();
  final TextEditingController _latController = new TextEditingController();
  final TextEditingController _lngController = new TextEditingController();
  final TextEditingController _facebookController = new TextEditingController();
  final TextEditingController _twitterController = new TextEditingController();
  final TextEditingController _linkedinController = new TextEditingController();
  final TextEditingController _youtubeController = new TextEditingController();
  final TextEditingController _SEO_company_page_titleController =
      new TextEditingController();
  final TextEditingController _SEO_company_page_metatagsController =
      new TextEditingController();
  final TextEditingController _is_recommendedController =
      new TextEditingController();
  final TextEditingController _views_countController =
      new TextEditingController();
  final TextEditingController _activeController = new TextEditingController();

  _onPressedStore() {
    setState(() {
      showLoaderDialogFunction(context);
      if (categoryvalue.isNotEmpty &&
          countryvalue != null &&
          cityvalue != null &&
          _slugController.text.trim().isNotEmpty &&
          _company_name_arController.text.trim().isNotEmpty &&
          _company_name_enController.text.trim().isNotEmpty &&
          _description_arController.text.trim().isNotEmpty &&
          _description_enController.text.trim().isNotEmpty &&
          _emailController.text.trim().isNotEmpty &&
          _phone_numberController.text.trim().isNotEmpty &&
          _whatsapp_numberController.text.trim().isNotEmpty &&
          _website_linkController.text.trim().isNotEmpty &&
          _addressController.text.trim().isNotEmpty &&
          _facebookController.text.trim().isNotEmpty &&
          _twitterController.text.trim().isNotEmpty &&
          _linkedinController.text.trim().isNotEmpty &&
          _youtubeController.text.trim().isNotEmpty) {
        _CompanieController.store(
            categoryvalue.toString(),
                countryvalue.toString(),
                cityvalue.toString(),
                _slugController.text.trim(),
                _company_name_arController.text.trim(),
                _company_name_enController.text.trim(),
                _description_arController.text.trim(),
                _description_enController.text.trim(),
                logo_image,
                _emailController.text.trim(),
                _phone_numberController.text.trim(),
                _whatsapp_numberController.text.trim(),
                _website_linkController.text.trim(),
                _addressController.text.trim(),
                _latController.text.trim(),
                _lngController.text.trim(),
                _facebookController.text.trim(),
                _twitterController.text.trim(),
                _linkedinController.text.trim(),
                _youtubeController.text.trim())
            .whenComplete(() {
          if (_CompanieController.status == true) {
            hideLoaderDialogFunction(context);
            ShowToast('success', _CompanieController.message);
            Navigator.push(context,
                MaterialPageRoute(builder: (context) => CompaniesIndex()));
          } else {
            hideLoaderDialogFunction(context);
            ShowToast('warning', _CompanieController.message);
          }
        });
      } else {
        hideLoaderDialogFunction(context);
        ShowToast(
            'error',
            language == "en"
                ? messages_en.getTranslation("pleasefillallfields")
                : messages_ar.getTranslation("pleasefillallfields"));
      }
    });
  }


  //get categories , countries , cities list data
  List<int> categoryvalue = [];
  List<S2Choice<int>> categoriesList = [];

  int countryvalue = 1;
  List<S2Choice<int>> countriesList = [];

  int cityvalue = 1;
  List<S2Choice<int>> citiesList = [];


  getCountryCities(int country_id){
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _CompanieController.get_CountryCites_for_companies_store(country_id).whenComplete((){
      if(_CompanieController.status == true){
        setState(() {
          data = _CompanieController.data;
          citiesList.clear();
          List citiyList = data["data"]["country_cities"];
          if(citiyList.length > 0){
            citiyList.forEach((element) {
              citiesList.add(
                S2Choice<int>(value: element["id"], title: element["name_ar"]),
              );
            });
          }

        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_CompanieController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });

  }




  read() async {

    //get list data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _CompanieController.get_Variables_for_companies_store().whenComplete((){
      if(_CompanieController.status == true){
        setState(() {
          data = _CompanieController.data;

          List categoryList = data["data"]["companies_categories"];
          if(categoryList.length > 0){
            categoryList.forEach((element) {
              categoriesList.add(
                S2Choice<int>(value: element["id"], title: element["name_ar"]),
              );
            });
          }

          List countryList = data["data"]["countries"];
          if(countryList.length > 0){
            countryList.forEach((element) {
              countriesList.add(
                S2Choice<int>(value: element["id"], title: element["name_ar"]),
              );
            });
          }

          List citiyList = data["data"]["country_cities"];
          if(citiyList.length > 0){
            citiyList.forEach((element) {
              citiesList.add(
                S2Choice<int>(value: element["id"], title: element["name_ar"]),
              );
            });
          }

        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_CompanieController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });


  }

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    read();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
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
            language == "en"
                ? messages_en.getTranslation("Add_new_company")
                : messages_ar.getTranslation("Add_new_company"),
            style: Theme.of(context).textTheme.title,
          ),
          centerTitle: true,
          leading: IconButton(
            icon: Icon(Icons.arrow_back),
            onPressed: () => Navigator.of(context).push(
                MaterialPageRoute(builder: (context) => CompaniesIndex())),
          ),
        ),
        body: Container(
          child: ListView(padding: EdgeInsets.all(10.0), children: <Widget>[
            Row(
              children: [
                Expanded(
                  child: TextField(
                    controller: _company_name_arController,
                    style: Theme.of(context).textTheme.body1,
                    keyboardType: TextInputType.text,
                    decoration: InputDecoration(
                      icon: Icon(Icons.account_balance_rounded),
                      hintText: language == "en"
                          ? messages_en.getTranslation("company_name_ar")
                          : messages_ar.getTranslation("company_name_ar"),
                      labelText: language == "en"
                          ? messages_en.getTranslation("company_name_ar")
                          : messages_ar.getTranslation("company_name_ar"),
                    ),
                  ),
                ),
                Expanded(
                  child: TextField(
                    controller: _company_name_enController,
                    style: Theme.of(context).textTheme.body1,
                    keyboardType: TextInputType.text,
                    decoration: InputDecoration(
                      icon: Icon(Icons.account_balance_rounded),
                      hintText: language == "en"
                          ? messages_en.getTranslation("company_name_en")
                          : messages_ar.getTranslation("company_name_en"),
                      labelText: language == "en"
                          ? messages_en.getTranslation("company_name_en")
                          : messages_ar.getTranslation("company_name_en"),
                    ),
                  ),
                ),
              ],
            ),
            TextField(
              controller: _description_arController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              maxLines: 4,
              decoration: InputDecoration(
                icon: Icon(Icons.announcement_outlined),
                hintText: language == "en"
                    ? messages_en.getTranslation("description_ar")
                    : messages_ar.getTranslation("description_ar"),
                labelText: language == "en"
                    ? messages_en.getTranslation("description_ar")
                    : messages_ar.getTranslation("description_ar"),
              ),
            ),
            TextField(
              controller: _description_enController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              maxLines: 4,
              decoration: InputDecoration(
                icon: Icon(Icons.announcement_outlined),
                hintText: language == "en"
                    ? messages_en.getTranslation("description_en")
                    : messages_ar.getTranslation("description_en"),
                labelText: language == "en"
                    ? messages_en.getTranslation("description_en")
                    : messages_ar.getTranslation("description_en"),
              ),
            ),

            // SmartSelect<int>.multiple(
            //   title: language == "en"
            //       ? messages_en.getTranslation("categories")
            //       : messages_ar.getTranslation("categories"),
            //   value: value,
            //   choiceItems: frameworks ,
            //   onChange: (state) => setState(() => value = state.value),
            // ),


    SmartSelect<int>.multiple(
        title: language == "en"
              ? messages_en.getTranslation("categories")
              : messages_ar.getTranslation("categories"),
      value: categoryvalue,
      choiceItems: categoriesList,
      choiceType: S2ChoiceType.checkboxes,
      modalType: S2ModalType.popupDialog,
      tileBuilder: (context, state) {
        return S2Tile.fromState(
          state,
          isTwoLine: true,
          leading: Icon(Icons.art_track),
          padding: EdgeInsets.all(0.0),
        );
      },
      modalFilter: true,
      onChange: (state) => setState(() => categoryvalue = state.value),
      modalConfig:S2ModalConfig(
        filterAuto: true,
      ) ,
    ),


            SmartSelect<int>.single(
              title: language == "en"
                  ? messages_en.getTranslation("country")
                  : messages_ar.getTranslation("country"),
              value: countryvalue,
              choiceItems: countriesList,
              choiceType: S2ChoiceType.radios,
              modalType: S2ModalType.popupDialog,
              tileBuilder: (context, state) {
                return S2Tile.fromState(
                  state,
                  isTwoLine: true,
                  leading: FaIcon(FontAwesomeIcons.globe),
                  padding: EdgeInsets.all(0.0),
                );
              },
              modalFilter: true,
              onChange: (state){
                    getCountryCities(state.value);
                    setState(() {
                      countryvalue = state.value;
                    });
              },
              modalConfig:S2ModalConfig(
                filterAuto: true,
              ) ,
            ),


            SmartSelect<int>.single(
              title: language == "en"
                  ? messages_en.getTranslation("city")
                  : messages_ar.getTranslation("city"),
              value: cityvalue,
              choiceItems: citiesList,
              choiceType: S2ChoiceType.radios,
              modalType: S2ModalType.popupDialog,
              tileBuilder: (context, state) {
                return S2Tile.fromState(
                  state,
                  isTwoLine: true,
                  leading:  FaIcon(FontAwesomeIcons.mapPin),
                  padding: EdgeInsets.all(0.0),
                );
              },
              modalFilter: true,
              onChange: (state) => setState(() => cityvalue = state.value),
              modalConfig:S2ModalConfig(
                filterAuto: true,
              ) ,
            ),



            // Padding(
            //   padding: const EdgeInsets.only(left :15.0,right: 15.0),
            //   child: TextField(
            //     controller: _categoriesController,
            //     style: Theme.of(context).textTheme.body1,
            //     keyboardType: TextInputType.text,
            //     decoration: InputDecoration(
            //       icon: Icon(Icons.art_track),
            //       hintText: language == "en"
            //           ? messages_en.getTranslation("categories")
            //           : messages_ar.getTranslation("categories"),
            //       labelText: language == "en"
            //           ? messages_en.getTranslation("categories")
            //           : messages_ar.getTranslation("categories"),
            //     ),
            //   ),
            // ),


            // TextField(
            //   controller: _country_idController,
            //   style: Theme.of(context).textTheme.body1,
            //   keyboardType: TextInputType.text,
            //   decoration: InputDecoration(
            //     icon:  FaIcon(FontAwesomeIcons.globe),
            //     hintText: language == "en"
            //         ? messages_en.getTranslation("country_id")
            //         : messages_ar.getTranslation("country_id"),
            //     labelText: language == "en"
            //         ? messages_en.getTranslation("country_id")
            //         : messages_ar.getTranslation("country_id"),
            //   ),
            // ),
            // TextField(
            //   controller: _city_idController,
            //   style: Theme.of(context).textTheme.body1,
            //   keyboardType: TextInputType.text,
            //   decoration: InputDecoration(
            //     icon:  FaIcon(FontAwesomeIcons.mapPin),
            //     hintText: language == "en"
            //         ? messages_en.getTranslation("city_id")
            //         : messages_ar.getTranslation("city_id"),
            //     labelText: language == "en"
            //         ? messages_en.getTranslation("city_id")
            //         : messages_ar.getTranslation("city_id"),
            //   ),
            // ),


            TextField(
              controller: _addressController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.map),
                hintText: language == "en"
                    ? messages_en.getTranslation("address")
                    : messages_ar.getTranslation("address"),
                labelText: language == "en"
                    ? messages_en.getTranslation("address")
                    : messages_ar.getTranslation("address"),
              ),
            ),
            TextField(
              controller: _slugController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.fingerprint),
                hintText: language == "en"
                    ? messages_en.getTranslation("slug")
                    : messages_ar.getTranslation("slug"),
                labelText: language == "en"
                    ? messages_en.getTranslation("slug")
                    : messages_ar.getTranslation("slug"),
              ),
            ),
            TextField(
              controller: _emailController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.envelope),
                hintText: language == "en"
                    ? messages_en.getTranslation("email")
                    : messages_ar.getTranslation("email"),
                labelText: language == "en"
                    ? messages_en.getTranslation("email")
                    : messages_ar.getTranslation("email"),
              ),
            ),
            TextField(
              controller: _phone_numberController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.phone),
                hintText: language == "en"
                    ? messages_en.getTranslation("phone_number")
                    : messages_ar.getTranslation("phone_number"),
                labelText: language == "en"
                    ? messages_en.getTranslation("phone_number")
                    : messages_ar.getTranslation("phone_number"),
              ),
            ),
            TextField(
              controller: _whatsapp_numberController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.whatsapp),
                hintText: language == "en"
                    ? messages_en.getTranslation("whatsapp_number")
                    : messages_ar.getTranslation("whatsapp_number"),
                labelText: language == "en"
                    ? messages_en.getTranslation("whatsapp_number")
                    : messages_ar.getTranslation("whatsapp_number"),
              ),
            ),
            TextField(
              controller: _website_linkController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.link),
                hintText: language == "en"
                    ? messages_en.getTranslation("website_link")
                    : messages_ar.getTranslation("website_link"),
                labelText: language == "en"
                    ? messages_en.getTranslation("website_link")
                    : messages_ar.getTranslation("website_link"),
              ),
            ),


            TextField(
              controller: _facebookController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.facebook),
                hintText: language == "en"
                    ? messages_en.getTranslation("facebook")
                    : messages_ar.getTranslation("facebook"),
                labelText: language == "en"
                    ? messages_en.getTranslation("facebook")
                    : messages_ar.getTranslation("facebook"),
              ),
            ),
            TextField(
              controller: _twitterController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.twitter),
                hintText: language == "en"
                    ? messages_en.getTranslation("twitter")
                    : messages_ar.getTranslation("twitter"),
                labelText: language == "en"
                    ? messages_en.getTranslation("twitter")
                    : messages_ar.getTranslation("twitter"),
              ),
            ),
            TextField(
              controller: _linkedinController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.linkedin),
                hintText: language == "en"
                    ? messages_en.getTranslation("linkedin")
                    : messages_ar.getTranslation("linkedin"),
                labelText: language == "en"
                    ? messages_en.getTranslation("linkedin")
                    : messages_ar.getTranslation("linkedin"),
              ),
            ),
            TextField(
              controller: _youtubeController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                icon: FaIcon(FontAwesomeIcons.youtube),
                hintText: language == "en"
                    ? messages_en.getTranslation("youtube")
                    : messages_ar.getTranslation("youtube"),
                labelText: language == "en"
                    ? messages_en.getTranslation("youtube")
                    : messages_ar.getTranslation("youtube"),
              ),
            ),
            logo_image == null
                ? Text(language == "en"
                    ? messages_en.getTranslation("noImageSelected")
                    : messages_ar.getTranslation("noImageSelected"))
                : Image.file(logo_image),
            RaisedButton(
              onPressed: getImage,
              child: Icon(
                Icons.add_a_photo,
                color: Colors.white,
              ),
            ),
            SizedBox(
              height: SizeConfig.screenWidth / screenHightRatio,
            ),
            RaisedButton(
              color: Theme.of(context).primaryColor,
              child: Text(
                language == "en"
                    ? messages_en.getTranslation("create")
                    : messages_ar.getTranslation("create"),
                style: Theme.of(context).textTheme.button,
              ),
              onPressed: _onPressedStore,
            ),
          ]),
        ));
  }
}
