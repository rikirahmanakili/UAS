public class MataKuliah {
    protected String kode_mtk;
    protected String name;
    protected Integer sks;

    public MataKuliah(String kode_mtk, String name, Integer sks){
        this.kode_mtk = kode_mtk;
        this.name = name;
        this.sks = sks;
    }

    public String getKode_mtk() { return kode_mtk; }
    public String getName() {return name;}
    public Integer getSks() {return sks; }
    public void cetak(){
        System.out.println(
                "--------MATA KULIAH--------" + "\n" +
                        "Kode        : " + this.getKode_mtk()  + "\n" +
                        "Nama        : " + this.getName() + "\n" +
                        "SKS         : " + this.getSks() + "\n" +
                "==============================" + "\n"
        );
    }
}