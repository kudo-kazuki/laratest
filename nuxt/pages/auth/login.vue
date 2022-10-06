<template>
<div class="container">
    <div id="loginMain">
        <h1>Login</h1>
        <div class="loginForm">
            <ul>
                <li><label for="email">email</label><input v-model="form.email" placeholder="email" type="text" id="email"></input></li>
                <li><label for="password">password</label><input v-model="form.password" placeholder="password" type="password" id="password"></input></li>
            </ul>
            <button @click="login" class="submitBtn">Login</button>
        </div>
        <nuxt-logo/>
    </div>

    <a id="debugLogin" href="javascript:void(0);" @click="inputDebugLoginInfo()">入力</a>
</div>
</template>

<style lang="scss" scoped>
.container{
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #eee;
}

#loginMain{
    text-align: center;
    background-color: #fff;
    box-shadow: 0 0 4px rgba(0,0,0,0.2);
    padding: 30px 40px;
    border-radius: 5px;

    h1{
        text-align: center;
        font-weight: bold;
        line-height: 1;
        font-size: 1.8rem;
        margin-bottom: 15px;
    }
}

.loginForm{
    text-align: left;
    margin-bottom: 32px;

    ul{
        li{
            margin-top: 20px;
            display: flex;
            align-items: center;

            &:first-child{
                margin-top: 0;
            }
        }

        input{
            margin-left: 8px;
        }

        label{
            font-weight: bold;
            width: 92px;
        }
    }
}

#debugLogin{
    position: fixed;
    top: 0;
    left: 0;
}
</style>

<script lang="ts">
import { defineComponent, reactive, useRoute, useRouter, useContext, useStore } from '@nuxtjs/composition-api'

interface State {
    email?: string
    password?: string
}

export default defineComponent({
    setup() {
        const router = useRouter()
        // const {$axios, $auth} = useContext()
        // @ts-ignore
        const context:any = router.app.context
        console.log(context)

        const form = reactive<State>({
            email: '',
            password: ''
        })

        const login = async () => {
            try{
                // ログインする
                const response = await context.$auth
                    .loginWith('laravelApi', {
                        data: form
                    })
                    .then(() => {
                        // ログインに成功したら、/にページ遷移
                        console.log('ログインしました');
                        router.push('/');
                    });
            } catch (error) {
                // ログインに失敗したら、コンソールに出力する
                console.log('ログイン失敗')
                console.log(error)
            }
        }

        const inputDebugLoginInfo = () => {
            form.email = 'admin@example.com';
            form.password = '123456789';
        }

        return {
            form,
            login,
            inputDebugLoginInfo
        }
    },
})

/*
export default {
    auth: false,
    data() {
        return {
            email: null,
            password: null
        }
    },
    methods: {
        async login() {
            try {
                // ログインする
                const response = await this.$auth
                    .loginWith('laravelApi', {
                        data: {
                            email: this.email,
                            password: this.password
                        }
                    })
                    .then(() => {
                        // ログインに成功したら、/にページ遷移
                        console.log('ログインしました');
                        this.$router.push('/');
                    });
                console.log(response);
            } catch (error) {
                // ログインに失敗したら、コンソールに出力する
                window.alert('ログイン失敗');
                console.log(error);
            }
        }
    }
}
*/
</script>
