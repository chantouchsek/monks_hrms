<template>
  <div>
    <b-card>
      <template slot="header">
        <h3 class="card-title">{{ $t('labels.backend.countries.titles.index') }}</h3>
        <div class="card-options" v-if="this.$app.user.can('create countries')">
          <b-button to="/countries/create" variant="success" size="sm">
            <i class="fe fe-plus-circle"></i> {{ $t('buttons.countries.create') }}
          </b-button>
        </div>
      </template>
      <b-datatable ref="datasource"
                   @context-changed="onContextChanged"
                   search-route="admin.countries.search"
                   delete-route="admin.countries.destroy"
                   action-route="admin.countries.batch_action" :actions="actions"
                   @bulk-action-success="onBulkActionSuccess">
        <b-table ref="datatable"
                 striped
                 bordered
                 show-empty
                 stacked="md"
                 no-local-sorting
                 :empty-text="$t('labels.datatables.no_results')"
                 :empty-filtered-text="$t('labels.datatables.no_matched_results')"
                 :fields="fields"
                 :items="dataLoadProvider"
                 sort-by="created_at"
                 :sort-desc="true"
                 :busy.sync="isBusy"
        >
          <template slot="HEAD_checkbox" slot-scope="data"></template>
          <template slot="checkbox" slot-scope="row">
            <b-form-checkbox :value="row.item.id" v-model="selected"></b-form-checkbox>
          </template>
          <template slot="actions" slot-scope="row">
            <b-button v-if="row.item.can_edit" size="sm" variant="primary" :to="`/countries/${row.item.id}/edit`" v-b-tooltip.hover :title="$t('buttons.edit')" class="mr-1">
              <i class="fe fe-edit"></i>
            </b-button>
            <b-button v-if="row.item.can_delete" size="sm" variant="danger" v-b-tooltip.hover :title="$t('buttons.delete')" @click.stop="onDelete(row.item.id)">
              <i class="fe fe-trash"></i>
            </b-button>
          </template>
        </b-table>
      </b-datatable>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'CountryList',
  data () {
    return {
      isBusy: false,
      selected: [],
      fields: [
        { key: 'checkbox' },
        { key: 'name', label: this.$t('validation.attributes.name'), sortable: true },
        { key: 'kh_name', label: this.$t('validation.attributes.kh_name'), sortable: true },
        { key: 'description', label: this.$t('validation.attributes.description') },
        { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
        { key: 'updated_at', label: this.$t('labels.updated_at'), 'class': 'text-center', sortable: true },
        { key: 'actions', label: this.$t('labels.actions'), 'class': 'nowrap' }
      ],
      actions: {
        destroy: this.$t('labels.backend.countries.actions.destroy')
      }
    }
  },
  watch: {
    selected (value) {
      this.$refs.datasource.selected = value
    }
  },
  methods: {
    dataLoadProvider (ctx) {
      return this.$refs.datasource.loadData(ctx.sortBy, ctx.sortDesc)
    },
    onContextChanged () {
      return this.$refs.datatable.refresh()
    },
    onDelete (id) {
      this.$refs.datasource.deleteRow({ meta: id })
    },
    onBulkActionSuccess () {
      this.selected = []
    }
  }
}
</script>
