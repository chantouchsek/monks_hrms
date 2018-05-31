<template>
  <div>
    <form @submit.prevent="onSubmit">
      <b-row class="justify-content-center">
        <b-col xl="6">
          <b-card>
            <h3 class="card-title" slot="header">{{ isNew ? $t('labels.backend.countries.titles.create') : $t('labels.backend.countries.titles.edit') }}</h3>
            <b-form-group
              :label="$t('validation.attributes.name')"
              label-for="name"
              horizontal
              :label-cols="3"
              :feedback="feedback('name')"
            >
              <b-form-input
                id="name"
                name="name"
                :placeholder="$t('validation.attributes.name')"
                v-model="model.name"
                :state="state('name')"
              ></b-form-input>
            </b-form-group>
            <b-form-group
              :label="$t('validation.attributes.kh_name')"
              label-for="name"
              horizontal
              :label-cols="3"
              :feedback="feedback('kh_name')"
            >
              <b-form-input
                id="kh_name"
                name="kh_name"
                :placeholder="$t('validation.attributes.kh_name')"
                v-model="model.kh_name"
                :state="state('kh_name')"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              :label="$t('validation.attributes.description')"
              label-for="description"
              horizontal
              :label-cols="3"
              :feedback="feedback('description')"
            >
              <b-form-textarea
                id="description"
                name="description[meta]"
                :rows="5"
                :placeholder="$t('validation.attributes.description')"
                v-model="model.description"
                :state="state('description')"
              ></b-form-textarea>
            </b-form-group>

            <b-row slot="footer">
              <b-col md>
                <b-button to="/countries" exact variant="danger" size="sm">
                  {{ $t('buttons.back') }}
                </b-button>
              </b-col>
              <b-col md>
                <b-button type="submit" variant="success" size="sm" class="float-right"
                          :disabled="pending"
                          v-if="isNew || $app.user.can('edit metas')">
                  {{ isNew ? $t('buttons.create') : $t('buttons.edit') }}
                </b-button>
              </b-col>
            </b-row>
          </b-card>
        </b-col>
      </b-row>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import form from '../mixins/form'

export default {
  name: 'CountryForm',
  mixins: [form],
  data () {
    return {
      modelName: 'country',
      resourceRoute: 'countries',
      listPath: '/countries',
      model: {
        status: null,
        kh_name: null,
        name: null,
        description: null
      }
    }
  },
  methods: {
    async getRoutes (search) {
      let {data} = await axios.get(this.$app.route('admin.routes.search'), {
        params: {
          q: search
        }
      })
      this.routes = data.items
    }
  }
}
</script>
