use rand::Rng;

fn main(){
    let flag : &str = "QVZESV9FdDVmNm1yc1QzdHZrZXgK";
    // init rng
    let mut rng = rand::thread_rng();
    let mut flag_low = Vec::new();
    let mut flag_up = Vec::new();
    // generates random number
    let rand_num = rng.gen_range(0,flag.len());
    // let rand_num = 0;
    // println!("{:?}",rand_num);
    
    //take last 4 bits
    for c in flag.as_bytes(){
        let tmp = c-((c>>4)<<4);
        flag_low.push(tmp);
    }
    // println!("{:?}", flag_low);
    
    // circular shift
    flag_low.rotate_right(rand_num);

    for c in flag.as_bytes(){
        let tmp = c>>4;
        flag_up.push(tmp);
    }
    // println!("{:?}", flag_up);
    
    for c in 0..flag.len() {
        let shifted:u8 = flag_up[c]<<4;
        print!("{}", (shifted+flag_low[c]) as char);
    }
    println!();

}
