<script>
import {assign, findIndex} from 'lodash';

export default {
  data() {
    return {
      notes: [],
    }
  },
  mounted() {
    this.loadNotes()
  },
  computed: {
  },
  methods: {
    loadNotes() {
      axios.get('/notes')
        .then(response => {
          this.notes = response.data.data
          this.notes.forEach((n) => { n.output = n.html })
        })
        .catch(error => {
          console.log(error.response.data)
        })
    },
    addNote() {
      this.notes.push({
        content: ''
      })
    },
    editNote(note) {
      console.log('aa')

      note.output = note.content

      const index = findIndex(this.notes, (n) => { return n.id === note.id })

      Vue.set(this.notes, index, note)
    },
    saveNote(note, content) {
        note.content = content

        // exists
        if (note.id)
          this.updateNote(note)
        else
          this.createNote(note)
    },
    updateNote(note) {
      axios.put('/notes/' + note.id, note)
        .then(response => {
            note = response.data.data
        })
        .catch(error => {
            console.log(error.response.data)
        })
    },
    createNote(note) {
      axios.post('/notes', note)
        .then(response => {
            assign(note, response.data.data)
        })
        .catch(error => {
            console.log(error.response.data)
        })
    },
    deleteNote(note) {
      axios.delete('/notes/' + note.id)
        .then(response => {
          this.notes = this.notes.filter(obj => {
            return obj.id !== note.id
          })
        })
    },
  },

}
</script>
