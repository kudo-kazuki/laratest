<template>
<div class="container">
    <div id="loginMain">
        <h1>Logout</h1>
        <button @click="logout" class="submitBtn">Logout</button>
    </div>
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
<script>

export default {
    data() {
        return {
            email: null,
            password: null
        };
    },
    methods: {
        // ログアウトする
        logout() {
            this.$auth.logout().then(() => {
                window.alert('ログアウトしました!');
                this.$router.push('/auth/login');
            });
        }
    },
};
</script>
