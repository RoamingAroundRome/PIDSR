<template>
  <div>
    <v-autocomplete
      label="Admitted"
      hint="Optional"
      persistent-hint
      filled
    ></v-autocomplete>
    <v-text-field
      type="date"
      label="Date Admitted/Seen/Consulted"
      filled
    ></v-text-field>
    <v-text-field
      type="date"
      label="Date of Onset"
      filled
    ></v-text-field>
    <v-text-field
      type="date"
      label="Date Died"
      hint="Optional"
      persistent-hint
      filled
    ></v-text-field>
    <v-autocomplete
      label="Lab Result"
      filled
    ></v-autocomplete>
    <v-autocomplete
      label="Specify Organism"
      filled
    ></v-autocomplete>
    <v-autocomplete
      label="Outcome"
      filled
    ></v-autocomplete>
  </div>
</template>

<script>
export default {
  // 
}
</script>