/**
 * @author TIB
 * @namespace admindev
 * ---------------------------------------------------------------
 * Oggetto gestione dell'interfaccia
 */
(function() {

  let ns = admindev.coni;
  let _this = null;

  /**
   * Costruttore della classe per la
   * @constructor
   */
  ns.Attivita = function() {
    _this = this;

    // -- valori attuali --
    this._utility = Utility;
    this._users = [];

    // -- elementi HTML --
    this._AttivitaTable = $('#coni_attivita_table')
    this._tableConfig = this._utility.getTableConfig();
    this._tableConfig.buttons = ['excel', 'pdf'];
    this._selUsers = $('#attivita_select_user');
    this._btnAssegna = $('#attivita_btn_assegna');
    this._modalAssegna = $('#attivita_modal_assegna');
    this._inpModalAssegnaTitle = $('#attivita_modale_assegna_input_titolo');
    this._selModalAssegnaUser = $('#attivita_modale_assegna_select_user');
    this._selModalAssegnaFsn = $('#attivita_modale_assegna_select_fsn');
    this._txtModalAssegnaDesc = $('#attivita_modale_assegna_descrizione');

    // -- Eventi
    this._btnAssegna.on('click', this._onclickBtnAssegna.bind(this));

    this._AttivitaTable.DataTable(this._tableConfig);
     //.buttons().container().appendTo('#coni_attivita_table_wrapper .col-md-6:eq(0)');
    this.getUsers();
  };

  ns.Attivita.getInstance = function() {
    if (_this === null) _this = new ns.Attivita();
    return _this;
  };

  // -- Handler Event
  ns.Attivita.prototype._onclickBtnAssegna = function(e) {
    this._modalAssegna.modal('show');
  };

  ns.Attivita.prototype.getUsers = function() {
    this._utility.request(G_baseUrl + 'api/getUsers', this._onSuccessGetUsers.bind(this), 'get_users', 'GET');
  };

  ns.Attivita.prototype._onSuccessGetUsers = function(ret) {
    this._users = ret.data;
    this._selUsers.append(new Option('',''));
    for (let i in this._users){
      this._selUsers.append(new Option(this._users[i].username,this._users[i].id));
      this._selModalAssegnaUser.append(new Option(this._users[i].username,this._users[i].id));
    }
  };

})();