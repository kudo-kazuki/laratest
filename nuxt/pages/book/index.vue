<template>
	<div>
		<h2>List</h2>
		<ul v-for="(book, i) in books" :key="i">
			<li>
				{{ book.title }}
				<nuxt-link :to="{ name: 'book-detail-id', params: { id: book.id } }">
					<button>詳細</button>
				</nuxt-link>
				<button @click="onClickDelete(book.id)">削除</button>
			</li>
		</ul>
		<h3>新規追加</h3>
		<input v-model="form.title" type="text" placeholder="title" /><br />
		<input v-model="form.author" type="text" placeholder="author" /><br />
		<button @click="onClickAdd">追加</button>
	</div>
</template>

<script lang="ts">
import { defineComponent, reactive, ref, useRouter, useFetch, useAsync, toRefs } from '@nuxtjs/composition-api'
import {BookService, BookResponse } from '@/service/book'

interface Form {
	title: string
	author: string
}

type Book = BookResponse

export default defineComponent({
    setup() {
        const form = reactive<Form>({
			title: '',
			author: '',
        })

		let books = ref<Book[]>([])

		useFetch(async () => {
			books.value = await BookService.fetchBooks()
		})

        const onClickAdd = async () => {
			await BookService.postBookData({ ...form })
			books.value = await BookService.fetchBooks()
			form.title = ''
			form.author = ''
        }

		const onClickDelete = async (bookId: number) => {
			await BookService.deleteBook(bookId)
			books.value = await BookService.fetchBooks()
        }

		return {
            books,
			form,
            onClickAdd,
			onClickDelete
        }
    }
})


/*
import Vue from 'vue'
interface DataType {
	form: Form
	books: Book[]
}

export default Vue.extend({
	async asyncData() {
		const books = await BookService.fetchBooks()
		return {
			books,
		}
	},
	data(): DataType {
		return {
			form: { title: '', author: '' },
			books: [],
		}
	},
	methods: {
		async onClickAdd() {
			await BookService.postBookData({ ...this.form })
			this.books = await BookService.fetchBooks()
			this.form = { title: '', author: '' }
		},
		async onClickDelete(bookId: number) {
			await BookService.deleteBook(bookId)
			this.books = await BookService.fetchBooks()
		},
	},
})
*/
</script>
