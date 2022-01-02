import { ExportToCsv } from 'export-to-csv';

export const moneyFormat = (number) => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 2
  }).format(number)
}

export const dateFormat = (date) => {
  return new Date(date)
    .toISOString()
    .substr(0, 10)
}

export const mapUTCDate = (date) => {
  const d = new Date(date)
  return `${d.getUTCFullYear()} ${d.getUTCMonth() + 1} ${d.getUTCDate()}`
}

export const capitalize = (s) => {
  if (typeof s !== 'string') return ''
  return s.charAt(0).toUpperCase() + s.slice(1)
}

export const isUndefined = (object) => (
  typeof(object) === 'undefined' || object
)

/**
 * Capitalizes first letters of words in string.
 * 
 * Reference: https://stackoverflow.com/questions/2332811/capitalize-words-in-string
 * @param {string} str String to be modified
 * @param {boolean=false} lower Whether all other letters should be lowercased
 * @return {string}
 * @usage
 *   capitalize('fix this string');     // -> 'Fix This String'
 *   capitalize('javaSCrIPT');          // -> 'JavaSCrIPT'
 *   capitalize('javaSCrIPT', true);    // -> 'Javascript'
 */
const capitalizeAlt = (str, lower = false) =>
  (lower ? str.toLowerCase() : str).replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase())

/**
 * Export data into CSV.
 * 
 * @param { Array } data 
 */
export const toCSV = (data, title = 'Data List', filename = 'generated') => {
  const options = { 
    title,
    filename,
    fieldSeparator: ',',
    quoteStrings: '"',
    decimalSeparator: '.',
    showLabels: true, 
    showTitle: true,
    useTextFile: false,
    useBom: true,
    useKeysAsHeaders: true,
  }
  const csvExporter = new ExportToCsv(options)
  return csvExporter.generateCsv(data)
}

/**
 * Slugify string.
 * Reference: https://gist.github.com/codeguy/6684588
 * 
 * @param { String } str 
 * @return { String }
 */
export const slugify = (str) => {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
      .replace(/\s+/g, '-') // collapse whitespace and replace by -
      .replace(/-+/g, '-'); // collapse dashes

  return str;
}