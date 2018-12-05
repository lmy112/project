<template>
  <section class="login container my-5">
    <div class="row justify-content-center no-gutters">
      <div class="col-12 col-md-5">
        <div class="admin">
          <div class="py-4 container">
            <h1 class="my-0 pt-4 pb-4 login__title">管理員登入</h1>
            <div class="form-group row mx-2 justify-content-center">
              <label for="email" class="col-2 col-form-label label--bg py-3"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAALXSURBVGhD7ZlNaxRBEIYHFQU/0JMIXtSL+g/Ej4y6M92DhlXQQdyedcGDOfkP1P0DhkgOmoCKHxdvigEVxCCIguLNsycP4s2rBtG3JuUcdivZmow6I/QDLxl6qt6u7untnt0EHo/H4xm/ML4+7iZp7MyNKLNzpNjZ67GLT9M9Dms2KHgicvZLnNmfopz5TDEc3jzSNF2NIu+JxUty9i7lcHpzQHHTQ8WOlLnG6c0g7sQH5EJHy2RmP9vUD5bUM6lIjbARPGGbegl74Ras9+9SkSohN0qjzWxXH7Q0xAJLKHLJPrarD2y1bam4MiIPtqsPfNDHpOLKyDp7iO3qI+wd2xY580MqUKPF3Hgr29ULdq03UpEaYVm9Zpv6wQf+pFSkRq2uPcE2zQBP5ZFU6HLC03jI6c2hfb69qcwSoyUVpuFGTm8WycVkHYqcXu6AjDLzDX+nKJbTmkur09qFwVzGE3qJoj/momu00T0O83g8Hk918OK3oeXsYWyxEzgrJunUxre/eeg9a36xzUzmMd0kpBxOr49+v78KxRzMC8vMO5wVC3TgldQCBvg2Hzi8yJPt/z6YxZ15x5n5JBQ2JLym3yRJ9wbFnldtz+7g7v485qzZg9OZfrfSzvxX0zFnOD2ga2obiFlK9KTu4AvXbk6vDv2Ihhm9gtmidySpU1GtzJxiiwJqk2KXEvd5qfKSwyDWYmbmBjtQydmnbFNAbWLsCGGTeEy1sE15MCP3JWOtjp47vp2tArqWYrTChN5iq3JgTR+RDNXCq3wYhmvYLqBrahNjterEY2ynB49zVjRTCvkf2KqA2qRYrbBCZthKDzp9IZlphaXwgK0KqE2K1YpqYis92GpfSWZa0U7HVgXUJsWqhZrYSk/VgdB/p9iqgNrEWK3qGEjUjfayVQG1SbFq/fOBDOxYv6m8c61oIJmdQuLzlcneZpsh6J6coxBqYhuPx+P5rwmCX5cx7PCxu06JAAAAAElFTkSuQmCC" width="32"></label>
              <input type="email" class="form-control py-3 col-10 input--bg" id="email" v-validate="'required|email'"
                name="email" v-model="user.account" placeholder="電子信箱">
            </div>
            <span class="row justify-content-center text-warning"><strong>{{ errors.first('email') }}</strong></span>
            <div class="form-group row m-2">
              <label for="password" class="col-2 col-form-label label--bg py-3"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAL1SURBVGhD7ZhNaBNBFMfjF+hRwY+z9uBRiEIVYTW7M7NaEA8JamZjKEhFqeBRpBgjQtWDCH5AwQ+8ixcR8eTNixfxIir15kX0UJFqUav/SV8kri+bTXc3CTo/+FPozvuYmbdvJpuzWCwWi8XyP1IqlZZ5FX+n0KLqaXUauiwCVXe1PCECURguFlfR0MHErajtnpZ3hFYfkPjPdsKYr0LLh24gfZgtWbAeAOQhudkL5H0u6U7Cbj33Kt5WctU/ZFkeEIGc5ZKMKyzCd/ytw11/dgcldBYJzLcmlUha3c2P5VeQ+96A+j7GJpNUWt2gENnjarUL5TDHJpKC8N4coVDZYbYegd5wCaQlLNKMU927gUJmg9D+cS54hKbRap96gXqJtvuDec4KY29SyPSp1WpLEeRdOGhYJmGs6nW37G4k0wY4DNctNIgYXU6rL7Io15BpupgDjw3aIvPuoPT2kQkLWnYeiUYemkbwdc6MTVs5rPRFLmCrEHyc8o3EqyjF2fdCKA35hHvQomnHcZZTrh3BrjxifGQuBJavuAe/pdUFyjEW2L1R1k/GMqX1iXvQlEmMcoyFp/1hzk/W+ncm0qm0MJFLlGMs+lZaab/sOCQfMz4yFyaiJsP/DAvld5LyjESUxR7OvheKVdMolzkZyP2UL4ur/W3YjY+cfavgq+OBiE55lbNtytwLwzaxryjQPBxM7T7sb6LcGxQOFtbj2Xlz/QiNZyRnR8ojq8m0LaiAU7x9U/IFDf2Tbn+HYEJvzaXRNAoE7eLSqKYoZCSLnoh5mTHg9d8G6QklNeOP+mspZCSLnohhkH5YJZqIAXV+lDdMJiR2jULEIvFEDBg4AaX58eG2+bhH7mOBNr4FXXKsnYQWRRoajaj4JZTCZzax+PqGlT0Dd/39WIeZD2E17yGh7ndHq2eN3j5ImAMTB90trO57NummcI5g3AMsgIDZ4HwyDWPqHEnuoDMH1xp5BX/r6HTjpuM5VWclDbVYLBaLxWJJRC73CxRnGCEppm59AAAAAElFTkSuQmCC" width="30"></label>
              <input v-validate="'required|alpha_num'" type="password" class="form-control py-3 col-10 input--bg" id="password"
                name="password" placeholder="請輸入密碼" v-model="user.password">
            </div>
            <span class="row justify-content-center text-warning"><strong>{{ errors.first('password') }}</strong></span>
          </div>
          <button class="btn btn-successColor py-3 btn-block" @click="login"><strong>登入後台</strong></button>
        </div>
      </div>
    </div>
  </section>
</template>

<script type="text/ecmascript-6">
import Vue from "vue";
import VeeValidate, { Validator } from "vee-validate";
import zh_TW from "vee-validate/dist/locale/zh_TW";
Vue.use(VeeValidate);
Validator.localize("zh_TW", zh_TW);
export default {
  data() {
    return {
      user: {
        account: "",
        password: "",
        u_id: ""
      }
    };
  },
  methods: {
    login() {
      this.$validator.validate().then(result => {
      if (result) {
      if (
        this.user.account === "admin@test.com" &&
        this.user.password === "admin"
      ) {
        this.user.u_id = "KOKDWEDOJOCO3"
        let userData={
          account:this.user.account,
          password:this.user.password,
          u_id:this.user.u_id,
          isLogin:true
        }
        this.$store.commit("setUserData", userData)
        this.$router.push("/admin/adminDessert");
        }else {
          return alert('登入失敗，請重新登入')
      }
        }})
    }
  }
};
</script>

<style scoped lang="scss">
@import "../assets/css/base.scss";

.admin {
  background-color: $primaryColor;
  color: white;
}

i {
  font-size: 1.875rem;
  color: $primaryColor;
}

.login__title {
  font-size: 1.875rem;
}

.btn-successColor {
  background-color: $successColor;
  border-radius: 0;
  color: $primaryColor;
  font-size: 1.125rem;

  &:hover {
    background-color: darken($successColor, 10%);
  }
}

.label--bg,
.input--bg {
  background-color: $infoColor;
  border-radius: 0;
  border-color: $infoColor;
}

.card {
  background-color: $infoColor;
}

.card-title {
  font-weight: 900;
  color: lighten($primaryColor, 30%);
}
</style>
