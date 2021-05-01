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
  ns.Ticket = function() {
    _this = this;
    // -- valori attuali --
    this.utility = Utility;

    // -- elementi HTML --
    this._ticketTable = $('#ticket_table_ticket')
    this._tableConfig = this.utility.getTableConfig();
    this._tableConfig.buttons = ['excel', 'pdf'];

    this._ticketTable.DataTable(this._tableConfig)
     .buttons().container().appendTo('#ticket_table_ticket_wrapper .col-md-6:eq(0)');
  };

  ns.Ticket.getInstance = function() {
    if (_this === null) _this = new ns.Ticket();
    return _this;
  };
})();