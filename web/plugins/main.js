import { 
  dateFormat, 
  mapUTCDate, 
  capitalize,
  slugify,
  isUndefined as undefinedObj 
} from '../utils/Util'
import { mapGetters } from 'vuex'
import Vue from 'vue'

Vue.mixin({
  computed: {
    ...mapGetters({
      isAdmin: 'isAdmin',
      isOfficer: 'isOfficer',
    })
  },
  
  methods: {
    slugify(string) {
      return slugify(string)
    },
    
    strCapitalize(string) {
      return capitalize(string)
    },
    
    formatDate(date) {
      return dateFormat(date)
    },

    formatStringDate(date) {
      return new Date(date)
        .toDateString()
    },
    
    /**
     * Filter records by given date (from & to)
     * It should be in the data() option and def is null
     * Expects each object data from array to contain "created_at"
     * in date format.
     * 
     * @param { Object }
     * @return { Array }
     */
    filterData({ data, from, to }) {
      if (from && to) {
        const formatFrom = new Date(mapUTCDate(from)).toLocaleDateString()
        const formatTo = new Date(mapUTCDate(to)).toLocaleDateString()

        if (formatFrom == formatTo) {
          console.log('current')
          return data.filter(item => {
            const orderDate = new Date(item.created_at).toLocaleDateString()
            return formatFrom == orderDate && formatTo == orderDate
          })
        } else {
          return data.filter(item =>
            new Date(item.created_at).getTime() >= new Date(mapUTCDate(from)).getTime() 
            && new Date(item.created_at).getTime() <= new Date(mapUTCDate(to)).getTime()
          )
        }
      }

      return data
    },

    /** @param { * } array */
    distinct(array) {
      const onlyUnique = (value, index, self) => { 
        return self.indexOf(value) === index;
      }

      return array.filter( onlyUnique );
    },

    moneyFormat(number) {
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
      }).format(number)
    },

    isUndefined(object) {
      return undefinedObj(object)
    }
  }
})